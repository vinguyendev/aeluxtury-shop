<?
//check security...
require_once("../../resource/security/security.php");
$module_id = 	95;

//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table			= 'product_attribute';
$id_field			= 'pra_id';
$name_field			= 'pra_name';
$fs_fieldupload		= "pra_icon_img";
$fs_filepath			= "../../../data/category/";
$fs_extension			= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize			= 2048;
$width_small_image	= 200;
$height_small_image	= 270;
$width_normal_image	= 270;
$height_normal_image	= 270;
$fs_insert_logo		= 0;


$menu						= new menu();
$arrayNameAttribute	= $menu->getAllChild("product_attribute","pra_id","pra_parent_id", 0, " 1 AND pra_status = 1", "pra_id, pra_name","pra_name ASC");
?>