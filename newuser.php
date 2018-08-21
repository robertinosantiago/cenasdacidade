<?php
include 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => __DIR__ . '/cache',
));

function validaForm($dados) {
  $retorno = true;
  if (!isset($_POST['email']) && empty($_POST['email'])) {
    return false;
  }

  return $retorno;
}

if (isset($_POST)) {
  validaForm($_POST);
  if (isset($_POST['email']) && !empty($_POST['email'])) {

  } else {
    // TODO: Lançar erro
  }
}

echo $twig->render('newuser.html');
