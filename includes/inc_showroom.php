<?

function countGood($cate_id) {
    $queryGo = "SELECT * FROM goods WHERE go_category_id = ".$cate_id;
    $db_goods = new db_query($queryGo);
    $count = 0;
    while ($goods = mysqli_fetch_assoc($db_goods->result)) {
        $count++;
    }

    return $count;
}
?>

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
            <a class="category-active">TỔNG HỢP SẢN PHẨM</a>
            <?
            $queryCate = "SELECT * FROM categories";
            $db_result = new db_query($queryCate);

            while ($category = mysqli_fetch_assoc($db_result->result)) {
            ?>
                <a href="category.html?cate_id=<?=$category['cate_id']?>"><?=$category["cate_name"]?></a>
            <? } ?>
        </div>
    </div>
    <h1 class="title-product-mobile">Danh sách sản phẩm</h1>
</div>

<div class="list-product">

    <div class="container-list">
        <div class="best-selling-product">
            <h3 class="title-category">Sản phẩm bán chạy nhất</h3>

            <div class="list-product-best-selling">
                <div class="position-col-5 product-detail-best">
                    <div class="image-product image-product-01">
                        <img src="https://i.ibb.co/D4YS5kK/76-0012-403.png">
                    </div>
                    <div class="info-product-01 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
                <div class="position-col-4 position-center product-detail-best">
                    <div class="image-product image-product-02">
                        <img src="https://i.ibb.co/fnncCGR/76-0411-copy.png">
                    </div>
                    <div class="info-product-02 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
                <div class="position-col-3 product-detail-best">
                    <div class="image-product image-product-03">
                        <img src="https://i.ibb.co/3yZg1L6/76-0229-703-copy.png">
                    </div>
                    <div class="info-product-03 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
            </div>

            <div class="list-product-best-selling">
                <div class="position-col-5 product-detail-best">
                    <div class="image-product image-product-04">
                        <img src="https://i.ibb.co/D4YS5kK/76-0012-403.png">
                    </div>
                    <div class="info-product-04 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
                <div class="position-col-3 position-center product-detail-best">
                    <div class="image-product image-product-03">
                        <img src="https://i.ibb.co/3yZg1L6/76-0229-703-copy.png">
                    </div>
                    <div class="info-product-03 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
                <div class="position-col-4 product-detail-best">
                    <div class="image-product image-product-02">
                        <img src="https://i.ibb.co/fnncCGR/76-0411-copy.png">
                    </div>
                    <div class="info-product-02 info-product">
                        <p>MACASSAR</p>
                        <p>SBTC340</p>
                    </div>
                </div>
            </div>

        </div>

        <div id="info-detail-product">

        </div>

        <?
            $queryCate = "SELECT * FROM categories";
            $db_result = new db_query($queryCate);

            while ($category = mysqli_fetch_assoc($db_result->result)) {
                if(countGood($category["cate_id"])>0) {
        ?>
                <div class="list-category-detail">
                    <h3 class="title-category"><?=$category["cate_name"]?></h3>
                    <div class="list-product-detail">
                        <?
                            $cate_id = $category["cate_id"];
                            $queryGo = "SELECT * FROM goods WHERE go_category_id = ".$cate_id;
                            $db_goods = new db_query($queryGo);
                            while ($good = mysqli_fetch_assoc($db_goods->result)) {
                                $picture_product = "../admin/modules/goods/images/".$good["go_picture"];
                        ?>
                                <div class="position-col-1 product-detail">
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

                        <? } ?>

                    </div>

                </div>

        <?} }?>

    </div>
</div>


<script>
    var coll = document.getElementsByClassName("product-detail-best");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            console.log('click'+i);
            this.classList.toggle("active");
            var content = document.getElementById("info-detail-product");
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    $(document).ready(function(){
        $('.list-product-detail').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 5000,
            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' style='font-size:48px;color:#E6AF83'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' style='font-size:48px;color:#E6AF83'></i></button>"
        });
    });


</script>
