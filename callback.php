<?php
/**
 * A simple example that shows how to use multiple providers.
 */
include 'vendor/autoload.php';
include_once 'config.inc.php';
require_once 'Dao/UserDao.php';
require_once 'model/User.php';

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;
use Hybridauth\User\Profile;
try {
    /**
     * Feed configuration array to Hybridauth.
     */
    $hybridauth = new Hybridauth($config);
    /**
     * Initialize session storage.
     */
    $storage = new Session();
    /**
     * Hold information about provider when user clicks on Sign In.
     */
    if (isset($_GET['provider'])) {
        $storage->set('provider', $_GET['provider']);
    }
    /**
     * When provider exists in the storage, try to authenticate user and clear storage.
     *
     * When invoked, `authenticate()` will redirect users to provider login page where they
     * will be asked to grant access to your application. If they do, provider will redirect
     * the users back to Authorization callback URL (i.e., this script).
     */
    if ($provider = $storage->get('provider')) {
        $hybridauth->authenticate($provider);
        $storage->set('provider', null);

        $adapter = $hybridauth->getAdapter($provider);

        $userProfile = $adapter->getUserProfile();
        $storage->set('loggedIn', $provider);

        if ($userProfile) {
          $user = UserDao::getInstance()->findByEmail($userProfile->email);

          if ($user) {
            $storage->set('user', $user->toArray());
          } else {
            $user = new User();
            $user->setFirstName($userProfile->firstName);
            $user->setLastName($userProfile->lastName);
            $user->setEmail($userProfile->email);
            $user->setPassword('');
            $user->setPhoto($userProfile->photoURL);
            $user->setRule('user');

            $newUser = UserDao::getInstance()->insert($user);

            if ($newUser){
              $storage->set('user', $newUser->toArray());
            }
          }
        } else {
          $storage->set('user', false);
        }
    }
    /**
     * This will erase the current user authentication data from session, and any further
     * attempt to communicate with provider.
     */
    if (isset($_GET['logout'])) {
        $adapter = $hybridauth->getAdapter($_GET['logout']);
        $adapter->disconnect();
        $storage->set('user', false);
        HttpClient\Util::redirect('index.php');
    }
    /**
     * Redirects user to home page (i.e., index.php in our case)
     */


    HttpClient\Util::redirect('dashboard.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
