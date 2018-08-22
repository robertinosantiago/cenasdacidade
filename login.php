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

function validaForm($dados) {

  if (!isset($_POST['email']) && empty($_POST['email'])) {
    return false;
  }

  return true;
}

if ($_POST) {
  if (!validaForm($_POST)) {
    // TODO: deve ser informado um email e senha
    error_log("nao validado");
    HttpClient\Util::redirect('index.php');
  }

  $user = UserDao::getInstance()->findByEmail($_POST['email']);
  if (!$user) {
    // TODO: Usuário não existe
    error_log("nao achei email");
    HttpClient\Util::redirect('login.php');
  }

  if (!password_verify($_POST['password'], $user->getPassword())) {
    // TODO: senha não confere
    HttpClient\Util::redirect('login.php');
  }

  $storage->set('user', $user->toArray());
  HttpClient\Util::redirect('dashboard.php');
}

echo $twig->render('login.html');
