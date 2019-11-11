<?
require_once("lang.php");

$array_return	= array("code" => 0, "msg" => "");
$productId		= getValue("productId", "str", "POST", 0);
$quantity		= getValue("quantity", "int", "POST", 0);
$type 			= getValue("type", "str", "POST", "recount");
if($quantity <= 0) $quantity = 1;

if($productId > 0 && $quantity > 0){
	switch ($type) {
		case 'delete':
			$myshoppingcart->recount(3, $productId, $quantity);
			break;

		default:
			$myshoppingcart->recount(1, $productId, $quantity);
			break;
	}

	$array_return	= array("code" => 1, "msg" => "");
}else{
	$array_return	= array("code" => 0, "msg" => "Vui lòng chọn sản phẩm");
}

die(json_encode($array_return));
?>
