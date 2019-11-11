<?
require_once("../../resource/security/security.php");

$module_id	= 9;
$module_name= "Nhân sự";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "personnel";
$id_field            = "per_id";
$name_field          = "per_name";
$break_page          = "{---break---}";
$fs_fieldupload      = "per_image";
$fs_filepath         = "../../../data/personnel/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize         = 2048;
$width_small_image   = 200;
$height_small_image  = 270;
$width_normal_image  = 270;
$height_normal_image = 270;
$fs_insert_logo      = 0;
?>