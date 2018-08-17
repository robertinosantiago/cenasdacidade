<?php
include 'vendor/autoload.php';
include 'config.inc.php';
require_once 'Dao/PhotoDao.php';
require_once 'model/Photo.php';

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
  HttpClient\Util::redirect('index.php');
}

$target_dir = "photos/";
$target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$file_name = $user['User']['id'] . '_' . md5(uniqid(rand(), true)) . '.' . $imageFileType;
$new_file =  $target_dir . $file_name;

// Check if image file is a actual image or fake image
if(isset($_POST)) {
    $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($new_file)) {
  $file_name = $user['User']['id'] . '_' . md5(uniqid(rand(), true)) . '.' . $imageFileType;
  $new_file =  $target_dir . $file_name;
    // echo "Sorry, file already exists.";
    // $uploadOk = 0;
}
// Check file size
// if ($_FILES["arquivo"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $new_file)) {
        $photo = new Photo();
        $photo->setTitle($_POST['titulo']);
        $photo->setPath($file_name);
        $photo->setUserId($user['User']['id']);
        $newPhoto = PhotoDao::getInstance()->insert($photo);
        if ($newPhoto) {
          HttpClient\Util::redirect('dashboard.php');
        } else {
          echo "error";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
