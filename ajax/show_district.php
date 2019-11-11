<?
require_once("lang.php");

$shipping_city = getValue("shipping_city", "int", "POST", 0);
$arrReturn     = array("html" => "", "ship" => "");
$html          = '';
$ship          = '';
if($shipping_city  > 0){
	$db_query = new db_query("SELECT * FROM cities WHERE cit_parent_id = " . $shipping_city . " AND cit_active = 1");
	$html .= '<label for="shipping_district">Quận/Huyện <abbr class="required" title="required">*</abbr></label>';
	$html .= '<select class="input-text" name="shipping_district" id="shipping_district">';
	while ($row = mysqli_fetch_assoc($db_query->result)) {
		$html .= '<option value="' . $row['cit_id'] . '">' . $row['cit_name'] . '</option>';                     
	}
	$html .= '</select>';
	unset($db_query);

	if($shipping_city == 5 || $shipping_city == 7){
		$ship = 'Liên hệ';
	}else{
		// $ship = $con_content_ship;
		$ship = 'Liên hệ';
	}
	$arrReturn = array("html" => $html, "ship" => $ship);
}
die(json_encode($arrReturn));