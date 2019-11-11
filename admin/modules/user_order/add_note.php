<?
include ("inc_security.php");

$recordId		= getValue("recordId", "int", "POST", 0);
$text				= getValue("text", "str", "POST", 0);
$arrayReturn	= array("code" => 0, "msg" => "");

// Lấy thông tin bản ghi
$db_query 	= new db_execute("UPDATE orders SET ord_note = '" . $text . "' WHERE ord_id =  " . $recordId);

unset($db_query);

die(json_encode($arrayReturn));
?>