<?php
include 'vendor/autoload.php';
require_once 'Dao/UserDao.php';
require_once 'model/User.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

echo $twig->render('login.html');
