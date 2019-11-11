<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "color_groups";
$id_field				= "cog_id";
$name_field				= "cog_name";
$fs_fieldupload		= "cog_picture";
$fs_filepath			= "../../../data/colors/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 2048;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page				= "{---break---}";
?>