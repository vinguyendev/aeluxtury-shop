<?
require_once("../../resource/security/security.php");

$module_id	= 109;
$module_name= "Tin tức";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "sevice";
$id_field            = "sev_id";
$name_field          = "sev_title";
$break_page          = "{---break---}";
$fs_fieldupload      = "sev_image";
$fs_filepath         = "../../../data/new/";
$fs_extension        = "gif,jpg,jpe,jpeg,png";
$fs_filesize         = 2048;
$width_small_image   = 290;
$height_small_image  = 240;
$width_normal_image  = 580;
$height_normal_image = 480;
$fs_insert_logo      = 0;

// Lấy danh sách NCC
$arrSup = array("0" => " -- Chưa có dịch vụ --");
$db_query = new db_query("SELECT * FROM sevice WHERE sev_active = 1 AND sev_parent_id = 0 ORDER BY sev_id ASC");
while ($row = mysqli_fetch_assoc($db_query->result)) {
	$arrSup[$row['sev_id']] = $row['sev_title'];
}
unset($db_query);
?>