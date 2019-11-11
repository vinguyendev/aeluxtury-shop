<?
require_once("../../resource/security/security.php");

$module_id	= 9;
$module_name= "Thương hiệu";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "album";
$id_field            = "alb_id";
$name_field          = "alb_title";
$break_page          = "{---break---}";
$fs_fieldupload      = "alb_image";
$fs_filepath         = "../../../data/album/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize         = 2048;
$width_small_image   = 600;
$height_small_image  = 400;
$width_normal_image  = 300;
$height_normal_image = 200;
$fs_insert_logo      = 0;
?>