<?

require_once("../../resource/security/security.php");

$module_id =1;

$module_name = "Categories";

//Check user login...

checkLogged();

//Check access module...

if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data

//Declare prameter when insert data

$fs_table            = "categories";

$id_field            = "cate_id";

$break_page          = "{---break---}";

?>