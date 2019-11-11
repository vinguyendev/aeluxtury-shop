<?
//check security...
require_once("../../resource/security/security.php");

$module_id = 17;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table	= "orders";
$id_field	= "ord_id";
$name_field = "ord_name";

$array_method_pay = array( 'Transfer' => 'Thanh toán online qua VTCPay',
									'PurchaseOrder' => 'Nhận hàng và thanh toán tại cửa hàng',
									'COD' => 'Giao hàng và thu tiền tại nhà');

$arrayStatus = array(1 => 'Chưa thanh toán',
							2 => 'Đã thanh toán',
							3 => 'Hủy'
							);

$arrShipTime = array(1 => 'Bất kì', 2 => 'Trong giờ hành chính', 3 => 'Ngoài giờ hành chính');


$arrCity = array();
$db_city = new db_query("SELECT * FROM cities ORDER BY cit_id ASC");
while ($row = mysqli_fetch_assoc($db_city->result)) {
	$arrCity[$row['cit_id']] = $row['cit_name'];
}
unset($db_city);
?>