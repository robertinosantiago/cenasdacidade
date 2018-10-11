<?php
include 'vendor/autoload.php';
require_once 'Dao/PhotoDao.php';

use Hybridauth\Storage\Session;
use Hybridauth\HttpClient;

echo "<h1>Inscrições encerradas.</h1>";

/*
$storage = new Session();
$user = $storage->get('user');

if (!$user) {
  HttpClient\Util::redirect('login.php?e=1');
}

if (!$_POST) {
  HttpClient\Util::redirect('dashboard.php?e=1');
}

$photo = PhotoDao::getInstance()->findById($_POST['photo']);

if ($photo->getUserId() != $user['User']['id']) {
  HttpClient\Util::redirect('dashboard.php?e=2');
}

if (PhotoDao::getInstance()->delete($photo->getId())) {
  unlink(realpath('photos/'.$photo->getPath()));
  HttpClient\Util::redirect('dashboard.php?e=3');
}
*/
