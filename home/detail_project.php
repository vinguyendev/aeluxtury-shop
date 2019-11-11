<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$recordId = getValue('iData', "int", "GET", 0);
if($recordId <= 0) redirect("/");

$news_info = array();
$sql_news  = "SELECT * FROM project WHERE prj_active = 1 AND prj_id = " .$recordId;

$db_new = new db_query($sql_news);
if(mysqli_num_rows($db_new->result) > 0){
	if($row = mysqli_fetch_assoc($db_new->result)){
		$news_info = $row;
	}
}
$db_new->close();
unset($db_new);

// fake request_url
$link = createlink("project", array('nTitle' => $news_info['prj_title'], "iData" => $news_info['prj_id']));
$curentLink = $link;

if($news_info["prj_title"] != "") $con_site_title  = trim($news_info["prj_title"]);
if($news_info["prj_description"] != "") $con_meta_description = trim($news_info["prj_description"]);
if($news_info["prj_logo"] != "") $con_news = getUrlImageProject($news_info['prj_logo'], "medium");

$arr_lv = array();
$db_lv = new db_query("SELECT * FROM properties WHERE ppe_type = 2 AND ppe_active = 1");
while ($row = mysqli_fetch_assoc($db_lv->result)) {
	$arr_lv[$row['ppe_id']] = $row['ppe_name'];
}
unset($db_lv);

$arr_dv = array();
$db_dv = new db_query("SELECT * FROM properties WHERE ppe_type = 1 AND ppe_active = 1");
while ($row = mysqli_fetch_assoc($db_dv->result)) {
	$arr_dv[$row['ppe_id']] = $row['ppe_name'];
}
unset($db_dv);

?>
<!DOCTYPE html>
<html lang="en-US" >
<head>
   <? include("../includes/inc_css_javascript.php");?>
</head>
<body>
	<? include("../includes/inc_menu_mobile.php");?>
    <? include("../includes/inc_header.php");?>
    <? include("../includes/inc_detail_project.php");?>
    <? include("../includes/inc_footer.php");?>

</body>
</html>
<?
ob_end_flush();
?>