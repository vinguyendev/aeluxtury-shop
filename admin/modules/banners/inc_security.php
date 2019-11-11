<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table				= "banners";
$id_field				= "ban_id";
$name_field				= "ban_name";
$fs_fieldupload		= "ban_picture";
$fs_filepath			= "../../../data/banner/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 4048;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;
$break_page	= "{---break---}";
//Array variable
$arrTarget				= array (	"_blank"=> "Trang mới",
									"_self"	=> "Hiện hành",
										);
$arrType             = array (	1 => "Banner Ảnh",
                                 2 => "Banner Flash",
                                 3 => "Banner HTML"
										);

$arrPositon				= array(	1 => "Banner top",
									2 => "Banner popup",
									3 => "Banner about",
									4 => "Banner project",
									5 => "Banner news",
									6 => "Banner sevice",

                             );
?>