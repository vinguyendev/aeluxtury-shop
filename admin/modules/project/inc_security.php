<?
require_once("../../resource/security/security.php");

$module_id		= 1;
$module_name	= "Project";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table            = "project";
$id_field            = "prj_id";
$fs_fieldupload      = "prj_logo";
$break_page          = "{---break---}";
$fs_filepath         = "../../../data/project/";
$fs_extension        = "gif,jpg,jpe,jpeg,png,mp4";
$fs_filesize         = 2024;
$width_small_image   = 237;
$height_small_image  = 237;
$width_normal_image  = 600;
$height_normal_image = 600;
$fs_insert_logo      = 0;

$arr_lv = array(0 => " - Chọn - " );
$db_lv = new db_query("SELECT * FROM properties WHERE ppe_type = 2 AND ppe_active = 1");
while ($row = mysqli_fetch_assoc($db_lv->result)) {
	$arr_lv[$row['ppe_id']] = $row['ppe_name'];
}
unset($db_lv);

$arr_dv = array(0 => " - Chọn - " );
$db_dv = new db_query("SELECT * FROM properties WHERE ppe_type = 1 AND ppe_active = 1");
while ($row = mysqli_fetch_assoc($db_dv->result)) {
	$arr_dv[$row['ppe_id']] = $row['ppe_name'];
}
unset($db_dv);

?>