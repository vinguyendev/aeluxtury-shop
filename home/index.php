<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$showMenu				= 1;
// Background trang chủ
$background_homepage	= "";
$background				= "";

?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="skrollr-body" class="ng-pageslide-body-closed page-loading ">
	
	<? include("../includes/inc_menu_mobile.php");?>
	<? include("../includes/inc_header.php");?>
	<? include("../includes/inc_home.php");?>
	<? include("../includes/inc_footer.php");?>
</body>
</html>
<?
ob_end_flush();
?>