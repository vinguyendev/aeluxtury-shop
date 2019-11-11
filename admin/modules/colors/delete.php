<?
include("inc_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","str","GET","0");
//Delete data with ID
$db_del = new db_execute("DELETE FROM ". $fs_table . " WHERE " . $id_field . "=" . $record_id);
unset($db_del);

redirect($fs_redirect);
?>