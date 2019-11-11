<?
require_once("../../resource/security/security.php");

$module_id	= 10;
$module_name= "Ý kiến khách hàng";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "comment";
$id_field		= "com_id";
$name_field		= "com_name";
$fs_fieldupload		= "com_picture";

$break_page		= "{---break---}";
$fs_filepath			= "../../../data/comment/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 500;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";
//Array variable
?>