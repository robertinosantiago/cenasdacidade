<?php
include 'vendor/autoload.php';
include 'config.inc.php';
use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;

$hybridauth = new Hybridauth($config);


$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

$storage = new Session();
$user = $storage->get('user');

$toast = array('type' => 'success', 'message' => 'Seja bem vindo!');

if ($user) {
  $loggedIn = $storage->get('loggedIn');
  echo $twig->render('inicio.html', array('user' => $user, 'loggedIn' => $loggedIn));
} else {
  echo $twig->render('inicio.html');
}
