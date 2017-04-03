# Real AES

## Introduction

Real AES provides an encryption method plugin for the Encrypt module
(https://drupal.org/project/encrypt).

Defuse PHP-encryption provides authenticated encryption via an Encrypt-then-MAC
scheme. AES-128 CBC is the symmetric encryption algorithm, SHA-256 the hash
algorithm for the HMAC. IV's are automatically and randomly generated. You do
not need to manage the IV separately, as it is included in the ciphertext.

Ciphertext format is: HMAC || iv || ciphertext

The HMAC verifies both IV and Ciphertext.

## Authenticated encryption

Authenticated encryption ensures data integrity of the ciphertext. When
decrypting, integrity is checked first. Further decrypting operations will only
be executed when the integrity check passes.
This prevents certain ciphertext attacks on AES CBC.

## Differences to the AES module:

By default:

- Uses AES
- Only one encryption mode
- No IV reuse
- Authenticated encryption (prevents ciphertext tampering attacks eg the
  Padding Oracle "Vaudenay" attack)
- No silent key replacement
- No database keys
- No generation of weak keys
- Unambiguous padding, allowing correct decryption of binary data ending in 0x00
- Will not accept "keys" of incorrect length
- No support for AES encryption of user passwords
- Fails hard when there are problems with encryption or decryption

## Requirements

The Defuse PHP-Encryption library from https://github.com/defuse/php-encryption.
Install it via Composer, preferably by using the Composer Manager module:
Make sure you have the composer_manager module installed according to its
README.txt, so you will be able to run the "composer drupal-update" command.
This will download the Defuse PHP-Encryption library to your Drupal
installation.

## General configuration

If you need the defuse php-encryption library, or use the Encrypt plugin just
enable Real AES and install the library.

### Generate a key

To generate a 128 bits random key, use the following command on the Unix CLI:

dd if=/dev/urandom bs=16 count=1 > /path/to/aes.key

This file MUST be stored outside of the docroot. Copy this file to an
off-server, safe backup. If you lose the key, you will not be able to decrypt
encrypted information in the database.

If you do not have access to dd, generate the file using drush on a working
Drupal installation:

drush php-eval 'echo drupal_random_bytes(16);' > /path/to/aes.key

### Storing the key for using it with Real AES

Use the Key module (https://www.drupal.org/project/key) to store your
generated key. Used in combination with the Encrypt module, you'll be able to
select your key when configuring an encryption profile using the Real AES
encryption method.

It is important to ensure a proper key. We suggest to use the "File" key
provider, but generate the key yourself.

dd if=/dev/urandom bs=16 count=1 > /path/to/encrypt_key.key

or

drush php-eval 'echo drupal_random_bytes(16);' > /path/to/encrypt_key.key

Supply the key provider with the path to this file.

## Encrypt plugin configuration

Real AES adds the "Authenticated AES" encryption method as a selectable option
when creating a new encryption profile with the Encrypt module. Use it in
combination with the generated key, stored by the Key module (see above).

## Usage

Use the Authenticated AES encryption method with the Encrypt module
(https://drupal.org/project/encrypt).

## Further reading

* Encryption in PHP:
  https://defuse.ca/secure-php-encryption.htm
* Defuse php-encryption readme:
  https://github.com/defuse/php-encryption/blob/master/README.md
* Authenticated encryption:
  https://en.wikipedia.org/wiki/Authenticated_encryption
* CBC Block mode:
  https://en.wikipedia.org/wiki/Block_cipher_mode_of_operation#Cipher_Block_Chaining_.28CBC.29
* HMAC:
  https://en.wikipedia.org/wiki/Hash-based_message_authentication_code
* SHA-256:
  https://en.wikipedia.org/wiki/SHA-2

## Key management

Key storage on the webserver is one of the weak points of this system. Consider
using Encrypt with a key management solution.

One example is https://www.drupal.org/project/townsec_key. We have not reviewed
this module or the system it connects with.

## Frequently given answers

Q Why not use AES-GCM?
A This is currently not supported by the php openssl library.

Q No AES-256?
A No.

Q But, why no AES-256??
A You won't need it unless your threat model includes adversaries having a
working and fast quantum computer implementing Grover's algorithm.

## Credits

This module was created by LimoenGroen - https://limoengroen.nl - after
carefully considering the various encryption modules and libraries.

The port to Drupal 8 was performed by Sven Decabooter, supported by Acquia.

The library doing the actual work, Defuse PHP encryption, is authored by
Taylor Hornby and Scott Arciszewski.

## Future plans:

Patch the module encrypted_files to use Defuse PHP-encryption and properly
derive a _key_ from a password.
