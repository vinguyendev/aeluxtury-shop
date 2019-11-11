<?
// Require class
require_once("../classes/database.php");
require_once("../classes/user.php");
require_once("../classes/menu.php");
require_once("../classes/denyconnect.php");
require_once("../classes/generate_form.php");
require_once("../classes/shoppingcart.php");

// Require function
require_once("../functions/functions.php");
require_once("../functions/function_website.php");
require_once("../functions/translate.php");
require_once("../functions/date_functions.php");
require_once("../functions/pagebreak.php");
require_once("../functions/rewrite_functions.php");

$lang_id 			= getValue("lang", "int", "COOKIE", 0);

// Danh sách từ được dịch phục vụ đa ngôn ngữ
$lang_display		= array();
$db_key_lang		= new db_query("SELECT * FROM user_translate WHERE lang_id = ".	$lang_id, __FILE__, "USE_SLAVE");
while($row_key_lang	= mysqli_fetch_assoc($db_key_lang->result)){
	$lang_display[$row_key_lang['ust_keyword']]	= $row_key_lang['ust_text'];
}
unset($db_key_lang);

// Config variable
require_once("../config/inc_config.php");

$myuser				= new user();
$myshoppingcart		= new shoppingcart();
// Biến dùng check thời gian thực thi
$fs_time_start		= microtime_float();

$module				= getValue("module", "str", "GET", "", "");
$iCat					= getValue("iCat", "int", "GET", 0);
$nCat					= "";

// Check xem trình duyệt là IE6 hay IE7
$isIE					= (strpos(@$_SERVER['HTTP_USER_AGENT'], "MSIE") !== false ? 1 : 0);
$isIE6				= (strpos(@$_SERVER['HTTP_USER_AGENT'], "MSIE 6") !== false ? 1 : 0);
$isIE7				= (strpos(@$_SERVER['HTTP_USER_AGENT'], "MSIE 7") !== false ? 1 : 0);
$isIElowVersion	= (($isIE6 || $isIE7) ? 1 : 0);

// Lấy thông tin thuộc tính
$arrayAttributeProduct 	= array();
$db_query 	=	 new db_query("SELECT * FROM product_attribute WHERE pra_status = 1 ORDER BY pra_order ASC");
while ($row = mysqli_fetch_assoc($db_query->result)) {
	$arrayAttributeProduct[$row['pra_id']] 	= $row;
}
unset($db_query);
?>