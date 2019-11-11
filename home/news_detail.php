<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$recordId = getValue('record_id', "int", "GET", 0);
if($recordId <= 0) redirect("/");

$news_info = array();
$sql_news  = "SELECT * FROM news_multi LEFT JOIN categories_multi ON cat_id = new_category_id WHERE new_active = 1 AND new_id = " .$recordId;

$db_new = new db_query($sql_news);
if(mysqli_num_rows($db_new->result) > 0){
	if($row = mysqli_fetch_assoc($db_new->result)){
		$news_info = $row;
	}
}
$db_new->close();
unset($db_new);

// fake request_url
$array_info = array("nTitle" => $news_info['new_title'], "iData" => $news_info['new_id']);
$news_url   = createlink('news_detail', $array_info);
$curentLink = $news_url;

if($news_info["new_meta_title"] != "") $con_site_title  = trim($news_info["new_meta_title"]);
if($news_info["new_meta_keyword"] != "") $con_meta_keywords = trim($news_info["new_meta_keyword"]);
if($news_info["new_meta_desc"] != "") $con_meta_description = trim($news_info["new_meta_desc"]);
if($news_info["new_picture"] != "") $con_news = "/data/new/".trim($news_info["new_picture"]);
?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body id="skrollr-body" class="ng-pageslide-body-closed page-loading ">
	<? include("../includes/inc_menu_mobile.php");?>
    <? include("../includes/inc_header.php");?>
    <? include("../includes/inc_detail_news.php");?>
    <? include("../includes/inc_footer.php");?>

</body>
</html>
<?
ob_end_flush();
?>