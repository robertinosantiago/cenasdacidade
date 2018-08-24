<?php
include 'vendor/autoload.php';
include 'config.inc.php';
require_once 'Dao/PhotoDao.php';

use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;
$hybridauth = new Hybridauth($config);

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

$toast = null;

$storage = new Session();
$user = $storage->get('user');

if(isset($_GET['e'])) {
  $e = $_GET['e'];
  switch ($e) {
    case 1:
      $toast = array('type' => 'error', 'message' => 'Operação inválida.');
      break;
    case 2:
      $toast = array('type' => 'error', 'message' => 'Você não tem permissão para excluir essa foto.');
      break;
    case 3:
      $toast = array('type' => 'success', 'message' => 'Foto removida com sucesso.');
      break;
    case 4:
      $toast = array('type' => 'error', 'message' => 'Cada partipante pode enviar no máximo 5 (cinco) fotos.');
  }
}

if ($user) {
  $loggedIn = $storage->get('loggedIn');
  $photos = PhotoDao::getInstance()->findByUserId($user['User']['id']);

  $total = PhotoDao::getInstance()->countByUserId($user['User']['id']);

  echo $twig->render('dashboard.html', array('toast' => $toast, 'user' => $user, 'photos' => $photos, 'total' => $total, 'loggedIn' => $loggedIn));
} else {
  $toast = array('type' => 'info', 'message' => 'Por favor, acesse sua conta.');
  echo $twig->render('login.html', array('toast' => $toast));
}
