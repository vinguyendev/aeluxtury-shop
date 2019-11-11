<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$showMenu				= 1;
// Background trang chủ
$background_homepage	= "";
$background				= "";
$con_site_title  = "Liên hệ với AeLuxury";
?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="skrollr-body" class="ng-pageslide-body-closed page-loading ">
	
	<? include("../includes/inc_menu_mobile.php");?>
	<? include("../includes/inc_header.php");?>
	<? include("../includes/inc_contact.php");?>
	<? include("../includes/inc_footer.php");?>
	
</body>
</html>
<?
ob_end_flush();
?>