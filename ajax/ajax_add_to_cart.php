<?php
require_once("lang.php");

$iPro         = getValue("iPro", "int", "POST", 0);
$quantity     = getValue("quantity","dbl","POST",1);
$return       = getValue("return","str","POST",base64_encode("index.php"));

$db_sel = new db_query("SELECT pro_onl_off FROM products WHERE pro_id = " . $iPro);
$row = mysqli_fetch_assoc($db_sel->result);

if($row['pro_onl_off'] == 1){ 
	$myshoppingcart->addtocart($iPro, $quantity);
	$array_return = array('code' => 1, 'total_product' => $myshoppingcart->count_product());
}else{
	$array_return = array('code' => 0, 'mess' => "Sản phẩm không bán online!");
}

die(json_encode($array_return));
?>