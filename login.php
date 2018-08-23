<?php
include 'vendor/autoload.php';
require_once 'Dao/UserDao.php';
require_once 'model/User.php';
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

$storage = new Session();
$toast = null;

function validaForm($dados) {

  if (!isset($_POST['email']) && empty($_POST['email'])) {
    return false;
  }

  if (!isset($_POST['password']) && empty($_POST['password'])) {
    return false;
  }

  return true;
}

if ($_POST) {
  if (!validaForm($_POST)) {
    HttpClient\Util::redirect('index.php?e=2');
  }

  $user = UserDao::getInstance()->findByEmail($_POST['email']);
  if (!$user) {
    HttpClient\Util::redirect('login.php?e=3');
  }

  if (!password_verify($_POST['password'], $user->getPassword())) {
    HttpClient\Util::redirect('login.php?e=4');
  }

  $storage->set('user', $user->toArray());
  HttpClient\Util::redirect('dashboard.php');
}

if(isset($_GET['e'])) {
  $e = $_GET['e'];
  switch ($e) {
    case 1:
      $toast = array('type' => 'info', 'message' => 'Por favor, acesse sua conta.');
      break;
    case 2:
      $toast = array('type' => 'error', 'message' => 'Você deve preencher todos os campos.');
      break;
    case 3:
      $toast = array('type' => 'error', 'message' => 'Não há uma conta associada a este email.');
      break;
    case 4:
      $toast = array('type' => 'error', 'message' => 'Senha não confere.');
      break;
  }
}

echo $twig->render('login.html', array('toast' => $toast));
