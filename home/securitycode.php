<?php
include("../config/inc_initsession.php");
if(!isset($_SESSION["session_security_code"])) $_SESSION["session_security_code"]	= rand(0000,9999);
$code	= $_SESSION["session_security_code"];

$im 			=	imagecreate(60, 21);
// white background and blue text
$bg 			=	imagecolorallocate($im, 255, 255, 255);
$red			=	imagecolorallocate($im, 254, 195, 0);
$textcolor  =  imagecolorallocate($im, rand(40,150), rand(0,10), 8);
// write the string at the top left
for($i=1;$i<=3;$i++){
	$red			=	imagecolorallocate($im, 254, rand(50,100), rand(0,255));
	imageline($im,rand(0,60),rand(0,18),rand(0,60),rand(0,18),$red);
}

imageline($im,0,8,80,rand(0,18),$textcolor);;
imagestring($im, 10, 10, 0,$code, $textcolor);

// output the image
header("Content-type: image/png");
imagepng($im);
?>