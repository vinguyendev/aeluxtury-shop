<?
require_once("../../resource/security/security.php");

$module_id	= 109;
$module_name= "Quản lý nhãn hàng";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "supplier";
$id_field            = "sup_id";
$name_field          = "sup_name";
$break_page          = "{---break---}";
$fs_fieldupload      = "sup_logo";
$fs_fieldupload2     = "sup_image_info";
$fs_filepath         = "../../../data/supplier/";
$fs_extension        = "gif,jpg,jpe,jpeg,png";
$fs_filesize         = 8096;
$width_small_image   = 290;
$height_small_image  = 240;
$width_normal_image  = 580;
$height_normal_image = 480;
$fs_insert_logo      = 0;
?>