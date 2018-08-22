<?php
include 'vendor/autoload.php';
use Hybridauth\HttpClient;
require_once 'Dao/UserDao.php';
require_once 'model/User.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

function validaForm($dados) {

  if (!isset($_POST['email']) && empty($_POST['email'])) {
    return false;
  }

  return true;
}

if (isset($_POST)) {
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
        HttpClient\Util::redirect('index.php');
      } else {
        // TODO: Não foi possível salvar
      }

    } else {
      // TODO: Indicar que já existe um usuario com este email.
    }
  } else {
    // TODO: Lançar erro
  }

}

echo $twig->render('newuser.html');
