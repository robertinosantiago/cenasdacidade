<?php
include 'vendor/autoload.php';
require_once 'Dao/PhotoDao.php';

use Hybridauth\Storage\Session;
use Hybridauth\HttpClient;


$storage = new Session();
$user = $storage->get('user');

if (!$user) {
  // TODO: Deve estar logado
  HttpClient\Util::redirect('login.php');
}

if (!$_POST) {
  // TODO: operação inválida
  HttpClient\Util::redirect('dashboard.php');
}

$photo = PhotoDao::getInstance()->findById($_POST['photo']);

if ($photo->getUserId() != $user['User']['id']) {
  // TODO: você não tem permissão para excluir essa foto
  HttpClient\Util::redirect('dashboard.php');
}

if (PhotoDao::getInstance()->delete($photo->getId())) {
  unlink(realpath('photos/'.$photo->getPath()));
  // TODO: removido com sucesso
  HttpClient\Util::redirect('dashboard.php');
}
