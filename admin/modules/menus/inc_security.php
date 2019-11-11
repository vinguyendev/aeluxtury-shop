<?
require_once("../../resource/security/security.php");
$module_id	= 26;
$module_name= "Menu";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "menus";
$field_id				= "mnu_id";
$field_name				= "mnu_name";
$fs_fieldupload		= "mnu_picture";
$fs_filepath			= "../../../data/menu/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 500;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;

require_once("../../resource/wysiwyg_editor/fckeditor.php");
$array_type 		= array(
									1	=> "TOP",
									2	=> "FOOTER",
									3 	=> "MENU QUY TRÌNH",
									4  => "Menu Dịch Vụ");
$mnu_position		= $array_type;
$mnu_target_array	=  array("_self"=>"Cùng cửa sổ", "_blank"=>"Cửa sổ mới");
$mnu_target			= array("_self"=>"Cùng cửa sổ", "_blank"=>"New window");
$sql					= "";
?>