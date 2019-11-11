<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();

$keyword    = getValue("s", "str", "GET", "", 1);
if($keyword == "") redirect(ROOT_PATH);


// Gán lại con_site_title
$con_site_title	= 'Kết quả tìm kiếm cho ' . htmlspecialbo($keyword);
// Background trang chủ
$background_homepage = "";
$background				= "";
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="tie-body" class="bp-nouveau archive post-type-archive post-type-archive-product woocommerce woocommerce-page wrapper-has-shadow block-head-1 magazine1 demo is-lazyload is-thumb-overlay-disabled is-desktop is-header-layout-3 has-header-ad sidebar-right has-sidebar hide_breaking_news hide_share_post_top hide_share_post_bottom no-js">
	<div class="background-overlay">
		<div id="tie-container" class="site tie-container">
			<div id="tie-wrapper">
				<? include("../includes/inc_header.php");?>
				<? include("../includes/inc_search.php");?>
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