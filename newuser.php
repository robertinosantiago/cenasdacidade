<?php
include 'vendor/autoload.php';
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;
require_once 'Dao/UserDao.php';
require_once 'model/User.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

$toast = false;

function validaForm($dados) {

  if (!isset($_POST['email']) && empty($_POST['email'])) {
    return false;
  }

  return true;
}

if ($_POST) {
  if (validaForm($_POST)) {
    $user = UserDao::getInstance()->findByEmail($_POST['email']);
    if (!$user) {
      $user = new User();
      $user->setFirstName($_POST['first_name']);
      $user->setLastName($_POST['last_name']);
      $user->setEmail($_POST['email']);

      $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
      //$user->setPhoto($userProfile->photoURL);
      $user->setRule('user');

      $newUser = UserDao::getInstance()->insert($user);

      if ($newUser){
        $storage = new Session();
        $storage->set('user', $newUser->toArray());
        HttpClient\Util::redirect('dashboard.php');
      } else {
        $toast = array('type' => 'error', 'message' => 'Não foi possível salvar seus dados.');
      }

    } else {
      $toast = array('type' => 'error', 'message' => 'Já existe uma conta associada a este email.');
    }
  } else {
    $toast = array('type' => 'error', 'message' => 'Você deve preencher todos os campos.');
  }

}

echo $twig->render('newuser.html', array('toast' => $toast));
