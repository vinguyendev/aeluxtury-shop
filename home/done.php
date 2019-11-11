<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$showMenu				= 1;
// Background trang chủ
$background_homepage	= "";
$background				= "";

// PaymentType:Visa;Direct:Master2018
$statusPayment	= getValue('status', 'int','GET', 0, 2);
$ord_id			= getValue('reference_number', 'int','GET', 0, 2);

switch ($statusPayment) {
		// thanh toán thành công
	case 1:
	$strLogStatus = "Payment is Successful !\n";
	break;
		// thanh toán tạm thời bị tạm giữ
	case 7:
	$strLogStatus = "Payment is Successful (pay with pending) !\n";
	break;
		// Giao dịch thất bại - mới chỉ ở trạng thái khởi tạo
	case 0:
	$strLogStatus = "Payment is Pending !\n";
	break;
	case -1:
	$strLogStatus = "Payment is Failed !\n";
	break;
	case -5:
	$strLogStatus = "OrderID is not valid";
	break;
	case -6:
	$strLogStatus = "Account's balance is insufficient";
	break;
	default:
	$strLogStatus = "Payment is Not Success!\n";
	break;
}

$db_update = new db_execute("UPDATE orders SET ord_note = '". $strLogStatus ."' WHERE ord_id = " . $ord_id);
unset($db_update);

if($statusPayment != 1){
	redirect("/");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="tie-body" class="home-page bp-nouveau home page-template-default page page-id-131 wrapper-has-shadow block-head-1 magazine1 demo is-lazyload is-thumb-overlay-disabled is-desktop is-header-layout-3 has-header-ad has-builder hide_breaking_news hide_share_post_top hide_share_post_bottom no-js">
	<div class="background-overlay">
		<div id="tie-container" class="site tie-container">
			<div id="tie-wrapper">
				<? include("../includes/inc_header.php");?>
				<? include("../includes/inc_done.php");?>
				<? include("../includes/inc_footer.php");?>
			</div>
			<? include("../includes/inc_menu_mobile.php");?>
		</div>
	</div>
	<? include("../includes/inc_footer_javascript.php");?>
</body>
</html>
<?
ob_end_flush();
?>