<div class="top-slider new">
    <div class="page-lines">
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
    </div>
    <div class="slide-caption">
        <div class="slide-title merriw">
            <div class="logo-large-1"><img src="<?=LANG_PATH.'data/background/'.$con_logo_top?>" alt="AELuxury"></div>
            <div class="logo-large-2"><img src="<?=LANG_PATH.'data/background/'.$con_logo_bottom?>" alt="AELuxury"></div>
        </div>
    </div>
    <ul class="cb-slideshow">
        <?
        $arrBanner = getBanner(1, 0, 1, 0, 5);
        if(count($arrBanner) > 0){
            foreach ($arrBanner as $key => $value) {
                echo '<li><span style="background: url(' . LANG_PATH.'data/banner/'. $value["ban_picture"] . ') no-repeat center center;"></span></li>';
            }
        }
        ?>
    </ul>
    <a href="#main-about" class="main-slider-arrow">
        <div class="icon icon-arrow-bottom"></div>
    </a>
</div>
<div class="main-content">
    <div class="main-about" id="main-about">
        <div class="container">
            <div class="row">
                <?  
                $db_about = new db_query("SELECT * FROM about LIMIT 1");
                $row = mysqli_fetch_assoc($db_about->result);
                ?>
                <div class="col-sm-5">
                    <div class="main-about-text">
                        <h1 class="h1"><?=$row['ab_title_home1']?></h1>
                        <h2 class="h3 gold"><?=$row['ab_title_home2']?><i></i></h2>
                        <div class="advantage-text">
                            <?=$row['ab_text1']?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="advantage-image">
                        <div class="square-default advantage-square"></div>
                        <div class="advantage-image-item lazyload" data-bgset="<?=LANG_PATH.'data/background/'.$row['ab_img1']?>"></div>
                    </div>
                </div>
                <?
                unset($db_about);
                ?>
                
            </div>
        </div>
    </div>
    <div class="main-wrap" style="position:relative">
        <div class="stretched-text skrollable " data-300-top="top:250px;" data-100-top="top:-90px;" data--200-top="top:100px;" data--500-top="top:500px" data--750-top="top:750px" data--5500-top="top:5500px" data-bottom="bottom:-50px" style="right:0; z-index:-1"> design </div>
        <div class="main-design ">
            <div class="container">
                <div class="main-design-top">
                    <div class="text-spec-block">
                        <h2 class="white h1">Chúng ta sẽ tạo ra cái gì?</h2>
                        <h3 class="block-text h3">Chọn loại phòng của bạn - và bạn sẽ tìm hiểu cách công việc của chúng tôi sẽ được xây dựng với bạn</h3></div>
                </div>
                <div class="main-design-types mainpage-types">
                    <div class="row">
                        <?
                        $cat_home = new db_query("SELECT * FROM categories_multi WHERE cat_type =  'product' AND cat_hot = 1 AND cat_active = 1 ORDER BY cat_order ASC");
                        while ($row = mysqli_fetch_assoc($cat_home->result)) {
                            $link = createlink("product", array('nTitle' => $row['cat_name'], "iData" => $row['cat_id']));
                            $link = createlink("product_cat", array('nTitle' => $row['cat_name'], "iData" => $row['cat_id'], 'nParent' => 'Dự Án'));
                            $img  = LANG_PATH.'data/category/'.$row['cat_picture'];
                            ?>
                                <div class="col-sm-3">
                                    <a href="<?=$link?>" class="main-types main-design-item">
                                        <div class="image lazyload" data-bgset="<?=$img?>"></div>
                                        <div class="subtitle">
                                            <div class="title merriw"> <?=$row['cat_name']?></div>
                                            <?=$row['cat_description']?>
                                        </div>
                                        <div class="description"><?= cut_string2($row['cat_meta_description'],150) ?></div>
                                    </a>
                                </div>
                            <?
                        }
                        unset($cat_home);
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="our-works ">
            <div class="container">
                <div class="filter-head">
                    <div class="main-about-text">
                        <h2 class="h1 gold">Dự án </h2>
                        <h3 class="white h3">Nổi bật của chúng tôi</h3></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="container portfolio-page portfolio-list">
                <div class="row insta tile">
                    <?
                        $db_pro = new db_query("SELECT * FROM products LEFT JOIN categories_multi ON (pro_category_id = cat_id) WHERE pro_hot = 1 ORDER BY pro_id DESC LIMIT 4");
                        while ($row = mysqli_fetch_assoc($db_pro->result)) {
                            $picture_product = getUrlImageProduct($row['pro_picture'], "medium");
                            $urlpreview      = createlink("product_detail",array("iData" => $row["pro_id"], "nTitle" => $row["pro_name"]));
                            ?>
                            <div class="col-sm-6 portf-col ng-scope" >
                                <a href="<?=$urlpreview?>" title="<?=$row["pro_name"]?>">
                                    <div class="portfolio-item-img"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=$picture_product?>" alt="<?=$row["pro_name"]?>" class="lazyload" /> </div>
                                    <div class="portfolio-item-info ">
                                        <div class="portfolio-item-title"><span class="merriw"><?=$row["pro_name"]?></span></div>
                                        <div class="portfolio-item-params">
                                            <div class="portfolio-item-square"><?=format_number($row['pro_mil'])?> м<sup>2</sup></div>
                                            <div class="portfolio-item-style"><?=$row['cat_name']?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?
                        }
                        unset($db_pro);
                    ?>
                    
                    <div class="clearfix ng-scope"></div>
                    <div class="loadmore-wrap readmore-wrap">
                        <div class="loadmore"><a class="readmore-link button" href="/category/du-an-id12">Xem tất cả dự án<span class="arr"></span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="partners-slider-block hidden-xs" id="instagram"></div>

                <div class="container list-product-home">
                    <h3 class="title-category-home"><a href="/showroom.html">Sản phẩm bán chạy nhất</a></h3>
                    <div class="list-product-detail">
                        <?
                        $queryGo = "SELECT * FROM goods WHERE go_category_id = 2";
                        $db_goods = new db_query($queryGo);
                        while ($good = mysqli_fetch_assoc($db_goods->result)) {
                            $picture_product = "../admin/modules/goods/images/".$good["go_picture"];
                            ?>
                            <div class="position-col-1 product-detail">
                                <div class="image-product-category">
                                    <img src="<?=$picture_product?>">
                                </div>
                                <div class="name-price-product-home">
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
                <style>
                    .list-product-home {
                        margin-top: 30px;
                        margin-bottom: 50px;
                    }

                    .title-category-home {
                        color: #DAAF85;
                        font-weight: bold;
                        font-size: 30px;
                        padding: 20px 0;
                    }
                    .name-price-product-home {
                        background-color: #ffffff;
                        height: 100px;
                        width: 100%;
                        padding: 20px;
                    }

                    .name-product-category p:nth-child(2n+1){
                        font-size: 20px;
                        color: #171717;
                    }

                    .name-product-category p:nth-child(2n){
                        font-size: 13px;
                        color: #909090;
                    }

                    .price-product {
                        float: right;
                    }

                    .price-product  p:nth-child(2n+1) {
                        font-size: 13px;
                        color: #ffffff;
                        font-weight: bold;
                    }

                    .price-product  p:nth-child(2n) {
                        font-size: 13px;
                        color: black;
                        font-weight: bold;
                    }

                    .slick-slide {
                        margin: 20px;
                    }
                </style>


        <div class="achievement-main">
            <div class="container">
                <div class="text-spec-block">
                    <h2 class="white h1">Tin tức</h2>
                    <h3 class="block-text h3">Cập nhật thông tin mới nhất</h3>
                </div>
                <div class="row">
                    <?
                        $db_news = new db_query("SELECT * FROM news_multi WHERE new_active = 1 ORDER BY new_id DESC LIMIT 4");
                        while ($row = mysqli_fetch_assoc($db_news->result)) {
                            $news_pic   = getUrlImageNews($row['new_picture'],"");
                            $array_info = array("nTitle" => $row['new_title'], "iData" => $row['new_id']);
                            $news_url   = createlink('news_detail', $array_info);
                            ?>
                            <a href="<?=$news_url?>" class="achievement-main-item" target="_blank">
                                <div class="image-wrap"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=$news_pic?>" alt="<?=$row['new_title']?>" class="lazyload" /> </div>
                                <div class="description"><?= cut_string2( $row['new_teaser'],50)?></div>
                                <div class="link">Chi tiết</div>
                            </a>
                            <?
                        }
                        unset($db_news);
                    ?>
                    
                </div>
                <div class="more-wrap-right"><a class="readmore-link" href="/tin-tuc/tin-tuc.html">Xem thêm<span class="arr"></span> </a></div>
            </div>
        </div>
        <?
        $name    = getValue("name", "str", "POST", "");
        $phone   = getValue("phone", "str", "POST", "");
        $email   = getValue("email", "str", "POST", "");
        $message = getValue("message", "str", "POST", "");
        $action  = getValue("action", "str", "POST", "");
        if($action == "contact"){
            $db_ex = new db_execute("INSERT INTO contact (cot_full_name,cot_email,cot_phone,cot_content,cot_create_time) VALUES 
                ('" . $name . "','" . $phone . "','" . $email . "','" . $message . "'," . time() . ")");
            echo '<script type="text/javascript">
            alert("Cảm ơn bạn đã gửi liên hệ! Chúng tôi sẽ gọi lại sớm nhất cho bạn!");
            window.location.href = "/";
        </script>';
        }
        ?>

        <form name="callback" class="main-about main-meet" method="post" >
            <div class="container">
                <div class="main-about-content row">
                    <div class="col-sm-5">
                        <div class="page-square square-default"></div>
                        <h2 class="first-title h1 gold">Để lại liên hệ</h2>
                        <h3 class="white h3">Chúng tôi sẽ gọi lại sớm cho bạn</h3></div>
                    <div class="col-sm-7">
                        <div class="main-about-advantages">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group"><span class="input input--madoka madoka_white">
                                        <input class="input__field input__field--madoka" type="text" id="input-37" required name="name"/>
                                        <label class="input__label input__label--madoka" for="input-37"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Tên</span></label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group"><span class="input input--madoka madoka_white">
                                        <input class="input__field input__field--madoka"  id="meet-38"  type="text"  required name="phone"/>
                                        <label class="input__label input__label--madoka" for="meet-38"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Điện thoại</span></label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group"><span class="input input--madoka madoka_white">
                                        <input class="input__field input__field--madoka"  id="meet-39"  type="email" required name="email"/>
                                        <label class="input__label input__label--madoka" for="meet-39"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">E-mail</span></label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="contact">
                            <div class="form-group "><span class="input input--madoka textarea--madoka madoka_white">
                                <textarea class="input__field input__field--madoka" id="meet-33"  name="message" placeholder="Nội dung"></textarea>
                                <label class="input__label input__label--madoka" for="meet-33"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg></label></span></div>
                            <button type="submit" class="readmore-link">Gửi<span class="arr"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--  <div class="content-sidebar ng-scope"><span type="overlay" class="ng-isolate-scope"><div class="sidebar-overlay"></div></span>
    <div class="sidebar-popup"><span close="×" class="ng-isolate-scope"><a href="javascript:void(0);" class="sidebar-close ng-binding">×</a></span>
        <div class="sidebar-content"></div>
    </div>
</div> -->

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