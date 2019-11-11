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
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="tie-body" class="bp-nouveau page-template page-template-template-masonry page-template-template-masonry-php page page-id-2580 wrapper-has-shadow block-head-1 magazine1 demo is-lazyload is-thumb-overlay-disabled is-desktop is-header-layout-3 has-header-ad full-width post-layout-1 has-mobile-share hide_breaking_news hide_share_post_top hide_share_post_bottom has-not-post-content has-not-post-title js">
	<div class="background-overlay">
		<div id="tie-container" class="site tie-container">
			<div id="tie-wrapper">
				<? include("../includes/inc_header.php");?>
				<? include("../includes/inc_album.php");?>
				<? include("../includes/inc_footer.php");?>
			</div>
			<? include("../includes/inc_menu_mobile.php");?>
		</div>
	</div>
	<? include("../includes/inc_footer_javascript.php");?>
	<script type='text/javascript' src='/js/js_album.js'></script>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('#masonry-grid').masonry('layout');
		})
	</script>
</body>
</html>
<?
ob_end_flush();
?>