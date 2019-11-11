<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "picture_sample";
$id_field				= "pis_id";
$name_field				= "pis_name";
$fs_fieldupload		= "pis_picture_main";
$fs_fieldupload1		= "pis_picture_color_main";
$fs_fieldupload2		= "pis_picture_color_highlight";
$fs_filepath			= "../../../data/sample/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 2048;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";

$arrType 	= array(0 => "Phòng Khách", 1 => "Phòng ngủ");
?>