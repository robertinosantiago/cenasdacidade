<?php
include 'vendor/autoload.php';
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;
require_once 'Dao/PhotoDao.php';
require_once 'Dao/VoteDao.php';
require_once 'model/Photo.php';
require_once 'model/Vote.php';

if (!isset($_POST['token']) || empty($_POST['token'])) {
  http_response_code(404);
  die('Sem token');
}

if (!isset($_POST['identificacao']) || empty($_POST['identificacao'])) {
  die('Sem identificação');
}

if (!isset($_POST['foto']) || empty($_POST['foto'])) {
  die('Sem foto');
}

$photo = PhotoDao::getInstance()->findByRelativeId($_POST['foto']);

if (!$photo) {
  die('Foto inválida');
}

$vote = new Vote();
$vote->setDocument($_POST['identificacao']);
$vote->setPhotoId($photo->getId());

$newVote = VoteDao::getInstance()->insert($vote);

if (!$newVote) {
  die('Não registrado');
}