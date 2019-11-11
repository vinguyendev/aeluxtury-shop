<?
require_once("../../resource/security/security.php");

$module_id	=  22;
$module_name= "User Recruitment";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "contractors";
$id_field		= "ctt_id";
$name_field		= "ctt_name";
$break_page		= "{---break---}";

?>