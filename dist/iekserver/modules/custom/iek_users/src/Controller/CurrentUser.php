<?php

namespace Drupal\iek\Controller;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrentUser extends ControllerBase
{
    protected $entityTypeManager;

    public function __construct(EntityTypeManagerInterface $entityTypeManager)
    {
        $this->entityTypeManager = $entityTypeManager;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('entity_type.manager')
        );
    }

    public function getLoginInfo(Request $request)
    {
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $iekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $iekUser = reset($iekUsers);
        if ($iekUser) {
            return $this->respondWithStatus([
                    'name' => $iekUser->name->value,
                ], Response::HTTP_OK);
        } else {
            return $this->respondWithStatus([
                    'message' => t("IEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }

    public function getIekUserData(Request $request)
    {
        $authToken = $request->headers->get('PHP_AUTH_USER');

        $iekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $iekUser = reset($iekUsers);
        if ($iekUser) {
            $user = $this->entityTypeManager->getStorage('user')->load($iekUser->user_id->target_id);
            if ($user) {
                $userName = $iekUser->name->value;
                $userSurname = $iekUser->surname->value;
                $userFathername = $iekUser->fathername->value;
                $userMothername = $iekUser->mothername->value;
                $userEmail = $user->mail->value;
                return $this->respondWithStatus([
                    'userName' => mb_substr($iekUser->name->value,0,4,'UTF-8') !== "####" ? $iekUser->name->value : '',
                    'userSurname' => mb_substr($iekUser->surname->value,0,4,'UTF-8') !== "####" ? $iekUser->surname->value : '',
                    'userFathername' => mb_substr($iekUser->fathername->value,0,4,'UTF-8') !== "####" ? $iekUser->fathername->value : '',
                    'userMothername' => mb_substr($iekUser->mothername->value,0,4,'UTF-8') !== "####" ? $iekUser->mothername->value : '',
                    'userEmail' => mb_substr($user->mail->value,0,4,'UTF-8') !== "####" ? $user->mail->value : '',
                ], Response::HTTP_OK);
            } else {
                return $this->respondWithStatus([
                    'message' => t("user not found"),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } else {
            return $this->respondWithStatus([
                    'message' => t("IEK user not found"),
                ], Response::HTTP_FORBIDDEN);
        }
    }


    private function respondWithStatus($arr, $s) {
        $res = new JsonResponse($arr);
        $res->setStatusCode($s);
        return $res;
    }
}
