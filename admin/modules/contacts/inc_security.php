<?
require_once("../../resource/security/security.php");

$module_id	=  22;
$module_name= "Contacts";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "contact";
$id_field		= "cot_id";
$name_field		= "cot_full_name";
$break_page		= "{---break---}";

?>