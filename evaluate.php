<?php
include 'vendor/autoload.php';
include 'config.inc.php';
require_once 'Dao/RatingDao.php';
require_once 'model/Rating.php';

use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;
use Hybridauth\HttpClient;
$hybridauth = new Hybridauth($config);

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

$storage = new Session();
$user = $storage->get('user');

if (!$user) {
  HttpClient\Util::redirect('login.php?e=1');
}

if ($user['User']['role'] != 'appraiser') {
  HttpClient\Util::redirect('dashboard.php?e=1');
}

if (!isset($_POST['photo_id']) && empty($_POST['photo_id'])) {
  HttpClient\Util::redirect('dashboard.php?e=1');
}

if (!isset($_POST['rate']) && empty($_POST['rate'])) {
  HttpClient\Util::redirect('dashboard.php?e=1');
}

$photo_id = $_POST['photo_id'];
$rate = $_POST['rate'];

$rating = new Rating();
$rating->setValue($rate);
$rating->setPhotoId($photo_id);
$rating->setUserId($user['User']['id']);

$newRating = RatingDao::getInstance()->insert($rating);
if ($newRating) {
  HttpClient\Util::redirect('dashboard.php');
  // TODO: mensagem de foto avaliada com sucesso
} else {
  echo "error";
}
