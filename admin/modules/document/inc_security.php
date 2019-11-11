<?
require_once("../../resource/security/security.php");

$module_id	= 9;
$module_name= "Quản lý tài liệu";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "document";
$id_field            = "doc_id";
$name_field          = "doc_title";
$break_page          = "{---break---}";
$fs_fieldupload      = "doc_image";
$fs_filepath         = "../../../data/feedback/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize         = 2048;
$width_small_image   = 200;
$height_small_image  = 270;
$width_normal_image  = 270;
$height_normal_image = 270;
$fs_insert_logo      = 0;

?>