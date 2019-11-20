<?
define("DO_NOT_INIT_SESSION", 1);

require_once("config.php");

ob_start("callback");

session_start();

$cate_id = $_GET['cate_id'];
$cate_name = "";

$queryCount = "SELECT count(*) as total FROM goods WHERE go_category_id = ".$cate_id;

$db_count = new db_query($queryCount);

$count = mysqli_fetch_assoc($db_count->result);
$totalProduct = $count["total"];


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

        <div class="inner-page-header">
            <div class="page-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
            <a href="/" class="" itemprop="item">
                <span itemprop="name" style="opacity: 1">Trang chủ</span>
            </a>
            <meta itemprop="position" content="1">
        </span>

                <ul class="breadcrumb ng-isolate-scope">
                    <li id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <span class="breadcrumb-arr"></span>
                        <span class="ng-binding ng-scope">Showroom</span>
                    </li>
                </ul>
            </div>
            <div class="container-header">
                <h1 class="title-product">Danh sách sản phẩm</h1>
                <div class="title-caption merriw">
                    <a href="#" class="readmore-link blog-form-anchor" style="padding: 0 80px 0 0;background-color:#2f2f2f ">Danh mục liên quan
                        <span class="arr"></span>
                    </a>
                </div>
                <div class="category-product">
                    <a >TỔNG HỢP SẢN PHẨM</a>
                    <?
                    $queryCate = "SELECT * FROM categories";
                    $db_result = new db_query($queryCate);

                    while ($category = mysqli_fetch_assoc($db_result->result)) {
                        ?>
                        <? if($category['cate_id']==$cate_id) { $cate_name=$category['cate_name'] ?>
                            <a class="category-active" href="category.html?cate_id=<?=$category['cate_id']?>"><?=$category["cate_name"]?></a>
                        <? } else { ?>
                            <a href="category.html?cate_id=<?=$category['cate_id']?>"><?=$category["cate_name"]?></a>
                        <? } ?>
                    <? } ?>
                </div>
            </div>
            <h1 class="title-product-mobile">Danh sách sản phẩm</h1>
        </div>

        <div class="list-product">
            <div class="container-list">
                <div class="list-category-detail-2">
                    <h3 class="title-category"><?=$cate_name?></h3>
                    <?
                        $queryGo = "SELECT * FROM goods WHERE go_category_id = ".$cate_id;
                        $db_goods = new db_query($queryGo);
                        $locat = 0;
                        while ($good = mysqli_fetch_assoc($db_goods->result)) {
                            $locat++;
                            $picture_product = "../admin/modules/goods/images/".$good["go_picture"];
                        ?>
                            <?if($locat%3==2 && $locat!=$totalProduct) { ?>
                                <div class="position-col-1 product-detail-2 position-center" id="<?=$good['go_id']?>" >

                                    <div class="image-product-category">
                                        <img src="<?=$picture_product?>">
                                    </div>
                                    <div class="name-price-product">
                                        <div class="name-product-category">
                                            <p><?=$good["go_name"]?></p>
                                            <p><?=$good["go_code"]?></p>
                                        </div>
                                        <div class="price-product">
                                            <p>M</p>
                                            <p><?=$good["go_price"]?> VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                            <?} if(($locat%3==0 || $locat==$totalProduct) && $locat%3!=2) { ?>
                                <div class="position-col-1 product-detail-2" id="<?=$good['go_id']?>">

                                    <div class="image-product-category">
                                        <img src="<?=$picture_product?>">
                                    </div>
                                    <div class="name-price-product">
                                        <div class="name-product-category">
                                            <p><?=$good["go_name"]?></p>
                                            <p><?=$good["go_code"]?></p>
                                        </div>
                                        <div class="price-product">
                                            <p>M</p>
                                            <p><?=$good["go_price"]?> VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-detail-product">
                                </div>
                            <?} if($locat%3==1 && $locat!=$totalProduct) { ?>
                                <div class="position-col-1 product-detail-2" id="<?=$good['go_id']?>">
                                    <div class="image-product-category">
                                        <img src="<?=$picture_product?>">
                                    </div>
                                    <div class="name-price-product">
                                        <div class="name-product-category">
                                            <p><?=$good["go_name"]?></p>
                                            <p><?=$good["go_code"]?></p>
                                        </div>
                                        <div class="price-product">
                                            <p>M</p>
                                            <p><?=$good["go_price"]?> VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                            <? } if($locat%3==2 && $locat==$totalProduct) {?>
                                <div class="position-col-1 product-detail-2 position-center" id="<?=$good['go_id']?>">

                                    <div class="image-product-category">
                                        <img src="<?=$picture_product?>">
                                    </div>
                                    <div class="name-price-product">
                                        <div class="name-product-category">
                                            <p><?=$good["go_name"]?></p>
                                            <p><?=$good["go_code"]?></p>
                                        </div>
                                        <div class="price-product">
                                            <p>M</p>
                                            <p><?=$good["go_price"]?> VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-detail-product">
                                </div>
                            <?}?>

                     <? } ?>

                </div>
            </div>

        </div>

        <? include("../includes/inc_footer.php");?>

    </div>

</div>

<? include("../includes/inc_footer_javascript.php");?>

</body>

</html>

<?

ob_end_flush();

?>

<script>

    $(document).ready(function () {
        $(document).on('click', '.product-detail-2', function() {

        });
    });


</script>


