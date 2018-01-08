<?php
session_start();
$font="fonts/times_new_yorker.ttf";
$acceptedChars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
$charstar='';
for($i=0;$i<=5;$i++){
	$start = rand(0,34);
	$ch=substr($acceptedChars,$start,1);
	$charstar.=$ch;
}
//$this->session->set_userdata('vercode',$charstar);
$_SESSION["vercode"] = $charstar;
$height = 38;
$width = 150;
$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 255, 255, 255);
$white = imagecolorallocate($image_p, 0, 0, 0);
$font_size = 60;
imagettftext($image_p, 20, 4, 30, 35, $white, $font, $charstar);
//imagestring($image_p, $font_size, 10, 10, $charstar, $white);
imagejpeg($image_p, null, 90);
?>