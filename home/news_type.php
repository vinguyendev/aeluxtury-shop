<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$nRwrite      = getValue("nCat", "str", "GET", "", 1);

$infoCategory = array();
$iCat         = 0;
$nCat         = "";

if($nRwrite != ""){
	$db_query 	= new db_query("SELECT * FROM categories_multi WHERE cat_active = 1 AND cat_name_rewrite = '" . $nRwrite . "'");
	if($row = mysqli_fetch_assoc($db_query->result)){
		$infoCategory 	= $row;
		$iCat 			= $row['cat_id'];
		$nCat 			= $row['cat_name'];
	}
	unset($db_query);
}

if(!$infoCategory) redirect(ROOT_PATH);
$catId 				= $iCat;
$htmlBreadcrumb 	= generateBreadcrumbs($iCat);

// Gán lại con_site_title
if(isset($infoCategory["cat_meta_title"]) && $infoCategory["cat_meta_title"] != ""){
	$con_site_title	= $infoCategory["cat_meta_title"];
}else{
	$con_site_title	= $infoCategory["cat_name"] . " | AeLuxury " . $infoCategory["cat_name"];
}

$meta_keyword      = (isset($infoCategory['cat_meta_keyword']) && $infoCategory['cat_meta_keyword'] != '')? $infoCategory['cat_meta_keyword'] : $infoCategory['cat_name'];

$con_meta_keywords = str_replace(" ", ",", $meta_keyword);
$con_meta_keywords = str_replace(",,", ",", $con_meta_keywords);

if(isset($infoCategory["cat_meta_description"]) && $infoCategory["cat_meta_description"] != ""){
	$con_meta_description	= $infoCategory["cat_meta_description"];
}else{
	$con_meta_description	= $infoCategory["cat_name"] . " | AeLuxury";
}
// Background trang chủ
$background_homepage = "";
$background				= "";
?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="skrollr-body" class="ng-pageslide-body-closed page-loading ">
    <? include("../includes/inc_menu_mobile.php");?>
    <? include("../includes/inc_header.php");?>
    <? include("../includes/inc_news_type.php");?>
    <? include("../includes/inc_footer.php");?>
    <? //include("../includes/inc_footer_javascript.php");?>
</body>
</html>
<?
ob_end_flush();
?>