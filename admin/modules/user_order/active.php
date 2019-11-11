<?
include ("inc_security.php");

$recordId		= getValue("recordId", "int", "POST", 0);
$value			= getValue("value", "int", "POST", 1);
$arrayReturn	= array("code" => 0, "msg" => "");

// Lấy thông tin bản ghi
$db_query 	= new db_query("SELECT * FROM orders WHERE ord_id = " . $recordId);
if($row = mysqli_fetch_assoc($db_query->result)){
	// Chưa active mới cho active

			$db_update		= new db_execute("UPDATE orders
														SET admin_id = " . $admin_id . ",  ord_status = " . $value . "
														WHERE ord_id = " . $recordId);
			unset($db_update);

		$arrayReturn['code'] = 1;


}else{
	$arrayReturn['msg'] 	= "Không tìm thấy thông tin đơn hàng.";
}
unset($db_query);

die(json_encode($arrayReturn));
?>