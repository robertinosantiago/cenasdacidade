<?php
include 'vendor/autoload.php';
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;
require_once 'Dao/PhotoDao.php';
require_once 'Dao/VoteDao.php';
require_once 'model/Photo.php';
require_once 'model/Vote.php';

$_POST = json_decode(file_get_contents("php://input"),true);

if (!isset($_POST['token']) || empty($_POST['token'])) {
  http_response_code(401);
  die('Sem token');
}

if (!isset($_POST['identificacao']) || empty($_POST['identificacao'])) {
  http_response_code(402);
  die('Sem identificação');
}

if (!isset($_POST['foto']) || empty($_POST['foto'])) {
  http_response_code(403);
  die('Sem foto');
}

$photo = PhotoDao::getInstance()->findByRelativeId($_POST['foto']);

if (!$photo) {
  http_response_code(404);
  die('Foto inválida');
}

$vote = new Vote();
$vote->setDocument($_POST['identificacao']);
$vote->setPhotoId($photo->getId());
$vote->setToken($_POST['token']);

$newVote = VoteDao::getInstance()->insert($vote);

if (!$newVote) {
  http_response_code(405);
  die('Não registrado');
}

http_response_code(200);
