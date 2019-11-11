<?
require_once("../../resource/security/security.php");

$module_id	= 19;
$module_name= "Colors";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table			= "colors";
$id_field			= "col_id";
$name_field			= "col_title";
$break_page			= "{---break---}";
$fs_insert_logo	= 0;

$arrayGroup = array();
$db_query 	= new db_query("SELECT * FROM color_groups WHERE cog_active = 1 ORDER BY cog_order ASC");
while($row = mysqli_fetch_array($db_query->result)){
	$arrayGroup[$row['cog_id']] 	= $row['cog_name'];
}

$arrayType	 = array(0 => "--Cả 2--", 1 => "Màu chính", 2 => "Màu nhấn");
?>