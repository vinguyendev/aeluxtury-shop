<?
require_once("../../resource/security/security.php");

$module_id	= 9;
$module_name= "Thuộc tính";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "properties";
$id_field            = "ppe_id";
$name_field          = "ppe_name";
$break_page          = "{---break---}";
$fs_fieldupload      = "";
$fs_filepath         = "../../../data/brands/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize         = 2048;
$width_small_image   = 200;
$height_small_image  = 270;
$width_normal_image  = 270;
$height_normal_image = 270;
$fs_insert_logo      = 0;

$arrType = array(1 => "Dịch vụ", 2 => "lĩnh vực");
?>