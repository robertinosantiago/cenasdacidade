<?php
$path = $_GET['photo'];
error_log(__DIR__ . '/photos/'.$path);

$type = exif_imagetype('photos/' . $path); // [] if you don't have exif you could use getImageSize()
$allowedTypes = array(
    1,  // [] gif
    2,  // [] jpg
    3,  // [] png
    6   // [] bmp
);
$im = null;
$filepath = 'photos/'.$path;
if (!in_array($type, $allowedTypes)) {
  $im  = imagecreate(150, 30); /* Create a black image */
  $bgc = imagecolorallocate($im, 255, 255, 255);
  $tc  = imagecolorallocate($im, 0, 0, 0);
  imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
  /* Output an errmsg */
  imagestring($im, 1, 5, 5, "Error loading $path", $tc);
  header("Content-Type: image/jpeg");
  imagejpeg($img);
} else {
  $header = null;
  switch ($type) {
    case 1 :
    $im = imageCreateFromGif($filepath);
    header("Content-Type: image/gif");
    imagegif($im);
    imagedestroy($im);
    break;
    case 2 :
    $im = imageCreateFromJpeg($filepath);
    header("Content-Type: image/jpeg");
    imagejpeg($im);
    imagedestroy($im);
    break;
    case 3 :
    $im = imageCreateFromPng($filepath);
    header("Content-Type: image/png");
    imagepng($im);
    imagedestroy($im);
    break;
    case 6 :
    $im = imageCreateFromBmp($filepath);
    header("Content-Type: image/bmp");
    imagebmp($im);
    imagedestroy($im);
    break;
  }


}
