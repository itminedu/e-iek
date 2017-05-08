<?php

namespace Drupal\iek\Controller;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class CurrentUser extends ControllerBase
{
    protected $entityTypeManager;
    protected $logger;
    protected $connection;

    public function __construct(
        EntityTypeManagerInterface $entityTypeManager,
        Connection $connection,
        LoggerChannelFactoryInterface $loggerChannel
        )
    {
        $this->entityTypeManager = $entityTypeManager;
        $this->connection = $connection;
        $this->logger = $loggerChannel->get('eiek');
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('entity_type.manager'),
            $container->get('database'),
            $container->get('logger.factory')
        );
    }

    public function getLoginInfo(Request $request)
    {
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {
            return $this->respondWithStatus([
                    'name' => $eiekUser->name->value,
                ], Response::HTTP_OK);
        } else {
            return $this->respondWithStatus([
                    'message' => t("EIEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }

    public function getEiekUserData(Request $request)
    {
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {
            $user = $this->entityTypeManager->getStorage('user')->load($eiekUser->user_id->target_id);
            if ($user) {
                $userName = $eiekUser->name->value;
                $userEmail = $user->mail->value;
                return $this->respondWithStatus([
                    'userName' => mb_substr($eiekUser->name->value,0,4,'UTF-8') !== "####" ? $eiekUser->name->value : '',
                    'userEmail' => mb_substr($user->mail->value,0,4,'UTF-8') !== "####" ? $user->mail->value : '',
                    'verificationCodeVerified' => $eiekUser->verificationcodeverified->value,
                ], Response::HTTP_OK);
            } else {
                return $this->respondWithStatus([
                    'message' => t("user not found"),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } else {
            return $this->respondWithStatus([
                    'message' => t("EIEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }

    public function sendVerificationCode(Request $request)
    {

        if (!$request->isMethod('POST')) {
			return $this->respondWithStatus([
					"message" => t("Method Not Allowed")
				], Response::HTTP_METHOD_NOT_ALLOWED);
    	}
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $trx = $this->connection->startTransaction();
        try {
        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {
            $user = $this->entityTypeManager->getStorage('user')->load($eiekUser->user_id->target_id);
            if ($user) {
                $postData = null;
                if ($content = $request->getContent()) {
                    $postData = json_decode($content);
                    $verificationCode = uniqid();
                    $eiekUser->set('verificationcode', $verificationCode);
                    $eiekUser->set('verificationcodeverified', FALSE);
                    $eiekUser->save();
                    $user->set('mail', $postData->userEmail);
                    $user->save();
                    $this->sendEmailWithVerificationCode($postData->userEmail, $verificationCode, $user);
                    return $this->respondWithStatus([
                        'userEmail' => $postData->userEmail,
                        'verCode' => $verificationCode,
                    ], Response::HTTP_OK);
                }
                else {
                    return $this->respondWithStatus([
                        'message' => t("post with no data"),
                    ], Response::HTTP_BAD_REQUEST);
                }

            } else {
                return $this->respondWithStatus([
                    'message' => t("user not found"),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } else {
            return $this->respondWithStatus([
                    'message' => t("EIEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
        } catch (\Exception $ee) {
            $this->logger->warning($ee->getMessage());
            $trx->rollback();
            return false;
        }

    }

    private function sendEmailWithVerificationCode($email, $vc, $user) {
        $mailManager = \Drupal::service('plugin.manager.mail');

        $module = 'eiek';
        $key = 'send_verification_code';
        $to = $email;
        $params['message'] = 'verification code=' . $vc;
        $langcode = $user->getPreferredLangcode();
        $send = true;

        $mail_sent = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

        if ($mail_sent) {
            $this->logger->info("Mail Sent successfully.");
        }
        else {
            $this->logger->info("There is error in sending mail.");
        }
        return;
    }


    public function verifyVerificationCode(Request $request)
    {

        if (!$request->isMethod('POST')) {
			return $this->respondWithStatus([
					"message" => t("Method Not Allowed")
				], Response::HTTP_METHOD_NOT_ALLOWED);
    	}
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {

            $user = $this->entityTypeManager->getStorage('user')->load($eiekUser->user_id->target_id);
            if ($user) {
                $postData = null;
                if ($content = $request->getContent()) {
                    $postData = json_decode($content);
                    if ($eiekUser->verificationcode->value !== $postData->verificationCode) {
                        return $this->respondWithStatus([
                            'userEmail' => $user->mail->value,
                            'verificationCodeVerified' => false
                        ], Response::HTTP_OK);
                    } else {
                        $eiekUser->set('verificationcodeverified', true);
                        $eiekUser->save();
                        return $this->respondWithStatus([
                            'userEmail' => $user->mail->value,
                            'verificationCodeVerified' => true
                        ], Response::HTTP_OK);
                    }
                }
            } else {
                return $this->respondWithStatus([
                    'message' => t("user not found"),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } else {
            return $this->respondWithStatus([
                    'message' => t("EIEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }

    public function saveUserProfile(Request $request)
    {

        if (!$request->isMethod('POST')) {
			return $this->respondWithStatus([
					"message" => t("Method Not Allowed")
				], Response::HTTP_METHOD_NOT_ALLOWED);
    	}
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {
            $postData = null;
            if ($content = $request->getContent()) {
                $postData = json_decode($content);
                $eiekUser->set('name', $postData->userProfile->userName);
                $eiekUser->save();
                return $this->respondWithStatus([
                    'message' => t("profile saved"),
                ], Response::HTTP_OK);
            } else {
                return $this->respondWithStatus([
                    'message' => t("post with no data"),
                ], Response::HTTP_BAD_REQUEST);
            }

        } else {
            return $this->respondWithStatus([
                    'message' => t("EIEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }

    private function respondWithStatus($arr, $s) {
        $res = new JsonResponse($arr);
        $res->setStatusCode($s);
        return $res;
    }
}
