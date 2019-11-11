<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
session_start();
$record_id			= getValue("record_id", "int", "GET", 0);
$arrayInfoStatic 	= array();
$db_query 			= new db_query("SELECT * FROM statics WHERE sta_id = " . $record_id . " AND sta_active = 1");
if($row = mysqli_fetch_assoc($db_query->result)){
	$arrayInfoStatic 	= $row;
}
unset($db_query);

if(!$arrayInfoStatic) redirect(ROOT_PATH);
$linkStatic 		= createlink("static", array("nTitle" => $arrayInfoStatic['sta_title'], "iData" => $record_id));

$breaadcrumb		= '<span itemscope="" itemtype="http://data-vocabulary.org/breadcrumb" class="item">
								<a href="' . $linkStatic . '" itemprop="url"><span itemprop="title">' . $arrayInfoStatic['sta_title'] . '</span></a>
							</span>';
$htmlBreadcrumb 	= generateBreadcrumbs(0, $breaadcrumb);

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
<body id="tie-body" class="home-page bp-nouveau home page-template-default page page-id-131 wrapper-has-shadow block-head-1 magazine1 demo is-lazyload is-thumb-overlay-disabled is-desktop is-header-layout-3 has-header-ad has-builder hide_breaking_news hide_share_post_top hide_share_post_bottom no-js">
	<div class="background-overlay">
		<div id="tie-container" class="site tie-container">
			<div id="tie-wrapper">
				<? include("../includes/inc_header.php");?>
				<? include("../includes/inc_static.php");?>
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