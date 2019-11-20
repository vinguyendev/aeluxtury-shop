<?

define("DO_NOT_INIT_SESSION", 1);

require_once("config.php");

ob_start("callback");

session_start();

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="vn-VI">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <? include("../includes/inc_css_javascript.php");?>

</head>

<body class="page-template page-template-tpl-blog page-template-tpl-blog-php page page-id-3026 page-parent  dt-transparent-default">



<div  class="wrapper">

    <div class="inner-wrapper">

        <? include("../includes/inc_header.php");?>

        <? include("../includes/inc_showroom.php"); ?>

        <? include("../includes/inc_footer.php");?>

    </div>

</div>

<? include("../includes/inc_footer_javascript.php");?>

</body>

</html>

<?

ob_end_flush();

?>