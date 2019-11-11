<?
require_once("../../resource/security/security.php");

$module_id		= 1;
$module_name	= "Products";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "products";
$id_field            = "pro_id";
$fs_fieldupload      = "pro_picture";
$break_page          = "{---break---}";
$fs_filepath         = "../../../data/product/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,mp4";
$fs_filesize         = 2024;
$width_small_image   = 120;
$height_small_image  = 140;
$width_normal_image  = 600;
$height_normal_image = 600;
$fs_insert_logo      = 0;


// Lấy danh sách danh mục
$menu				= new menu();
$arrCategory	= $menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, " cat_type ='product'", "cat_id,cat_name","cat_order ASC, cat_name ASC","cat_has_child");

?>