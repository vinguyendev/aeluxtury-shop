<?
define("DO_NOT_INIT_SESSION", 1);
require_once("config.php");
ob_start("callback");
session_start();
$catId 				= 0;
$breaadcrumb		= '<span itemscope="" itemtype="http://data-vocabulary.org/breadcrumb" class="item">
								<a href="' . ROOT_PATH . 'tin-tuc.html" itemprop="url"><span itemprop="title">Tin tức</span></a>
							</span>';
$htmlBreadcrumb 	= generateBreadcrumbs(0, $breaadcrumb);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vn-VI">
<head>
	<? include("../includes/inc_css_javascript.php");?>
</head>
<body class="page-template page-template-tpl-blog page-template-tpl-blog-php page page-id-3026 page-parent  dt-transparent-default">
<div class="loader-wrapper"> <img src="../wp-content/themes/painting/images/loader.gif" alt="Loader" /></div>

<div  class="wrapper">
	<div class="inner-wrapper">
		<? include("../includes/inc_header.php");?>
		<? include("../includes_news/inc_home.php");?>
		<? include("../includes/inc_footer.php");?>
	</div>
</div>
<? include("../includes/inc_footer_javascript.php");?>


</body>
</html>
<?
ob_end_flush();
?>
