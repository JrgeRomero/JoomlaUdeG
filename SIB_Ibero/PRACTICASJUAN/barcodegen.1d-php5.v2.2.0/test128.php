<?php
require('class/BCGFont.php');
require('class/BCGColor.php');
require('class/BCGDrawing.php');
require('class/BCGcode128.barcode.php');
 
$font = new BCGFont('./class/font/Arial.ttf', 10);
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);

$text = isset($_GET['text']) ? $_GET['text'] : 'HELLO';
 
// Barcode Part
$code = new BCGcode128();
$code->setScale(1);
$code->setThickness(30);
$code->setForegroundColor($color_black);
$code->setBackgroundColor($color_white);
$code->setFont($font);
$code->setStart(NULL);
$code->setTilde(true);
$code->parse($text);
 
// Drawing Part
$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();
 
header('Content-Type: image/png');
 
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>