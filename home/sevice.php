<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$showMenu				= 1;
// Background trang chủ
$background_homepage	= "";
$background				= "";
$con_site_title  = "Dịch vụ của Design95";
?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <? include("../includes/inc_css_javascript.php");?>
</head>
<body>
	
	<? include("../includes/inc_menu_mobile.php");?>
	<? include("../includes/inc_header.php");?>
	<? include("../includes/inc_sevice.php");?>
	<? include("../includes/inc_footer.php");?>

</body>
</html>
<?
ob_end_flush();
?>