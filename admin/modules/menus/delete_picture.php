<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

$record_id		= getValue("record_id","int","GET","0");
$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("edit.php?record_id=" . $record_id)));

checkRowUser($fs_table,$field_id,$record_id,$returnurl);


//Delete data with ID
$db_del = new db_execute("UPDATE ". $fs_table ." SET mnu_picture='' WHERE " . $field_id . "=" . $record_id);
unset($db_del);

redirect($returnurl);
?>