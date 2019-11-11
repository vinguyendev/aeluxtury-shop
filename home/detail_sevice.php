<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$recordId = getValue('iData', "int", "GET", 0);
if($recordId <= 0) redirect("/");

$news_info = array();
$sql_news  = "SELECT * FROM sevice WHERE sev_active = 1 AND sev_id = " .$recordId;

$db_new = new db_query($sql_news);
if(mysqli_num_rows($db_new->result) > 0){
	if($row = mysqli_fetch_assoc($db_new->result)){
		$news_info = $row;
	}
}
$db_new->close();
unset($db_new);

// fake request_url
$array_info = array("nTitle" => $news_info['sev_title'], "iData" => $news_info['sev_id']);
$news_url   = createlink('news_detail', $array_info);
$curentLink = $news_url;

if($news_info["sev_title"] != "") $con_site_title  = trim($news_info["sev_title"]);
if($news_info["sev_title"] != "") $con_meta_keywords = trim($news_info["sev_title"]);
if($news_info["sev_title"] != "") $con_meta_description = trim($news_info["sev_title"]);

?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body>
	
	<? include("../includes/inc_menu_mobile.php");?>
	<? include("../includes/inc_header.php");?>
	<? include("../includes/inc_detail_sevice.php");?>
	<? include("../includes/inc_footer.php");?>
			

	<?// include("../includes/inc_footer_javascript.php");?>
	
</body>
</html>
<?
ob_end_flush();
?>