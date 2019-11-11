<?
require_once("../../resource/security/security.php");

$module_id = 81;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table     = "stores";
$id_field     = "sto_id";
$name_field   = "sto_name";
$break_page   = "{---break---}";
$fs_fieldupload 	= "sto_avatar";
$fs_filepath  = "../../../data/avatar/";
$fs_extension = "gif,jpg,jpe,jpeg,png";
$fs_filesize  = 400;
$fs_insert_logo		= 0;
$arrType             = array (	""			=> "Tất cả",
											"onway" 	=> "Kho online",
                                 "shop" 	=> "Kho offline"
										);

$array_city	= array('-1' => "--Chọn tỉnh thành--");
$db_query	= new db_query("SELECT * FROM city WHERE cit_parent_id = 0 AND cit_active = 1 ORDER BY cit_order ASC, cit_name ASC");
while($row = mysqli_fetch_assoc($db_query->result)){
	$array_city[$row['cit_id']]	= $row['cit_name'];
}
unset($db_query);
?>