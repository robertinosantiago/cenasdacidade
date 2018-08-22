<?php
include 'vendor/autoload.php';
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

$storage = new Session();

$storage->set('user', false);
HttpClient\Util::redirect('index.php');
