<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
session_start();
$record_id			= getValue("iData", "int", "GET", 0);
$arrayInfoProduct	= getInfoProduct($record_id);

if(!$arrayInfoProduct || $arrayInfoProduct['pro_active']	!= 1) redirect(ROOT_PATH);

if($arrayInfoProduct["pro_meta_title"] != "") $con_site_title	= trim($arrayInfoProduct["pro_meta_title"]);
if($arrayInfoProduct["pro_meta_keyword"] != "") $con_meta_keywords	= trim($arrayInfoProduct["pro_meta_keywords"]);
if($arrayInfoProduct["pro_meta_description"] != "") $con_meta_description	= trim($arrayInfoProduct["pro_meta_description"]);

// Background trang chủ
$background_homepage = "";
$background				= "";

$urlDetail          = "http://" . $_SERVER["SERVER_NAME"] . createlink("product", array("nTitle" => $arrayInfoProduct["pro_name"], "iData" => $record_id));
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="skrollr-body" class="ng-pageslide-body-closed page-loading ">
	<? include("../includes/inc_menu_mobile.php");?>
	<? include("../includes/inc_header.php");?>
	<? include("../includes/inc_detail.php");?>
	<? include("../includes/inc_footer.php");?>

</body>
</html>
<?
ob_end_flush();
?>