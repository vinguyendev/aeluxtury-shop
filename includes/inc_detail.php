<?
$linkProduct       = createlink("product_detail", array("iData" => $arrayInfoProduct['pro_id'], "nTitle" => $arrayInfoProduct['pro_short_name']));
$linkProductFull   = DOMAIN_SITE . $linkProduct;
$imageProductSmall = getUrlImageProduct($arrayInfoProduct['pro_picture'], "small");
$imageProduct      = getUrlImageProduct($arrayInfoProduct['pro_picture'], "medium");
$imageProductFull  = getUrlImageProduct($arrayInfoProduct['pro_picture'], "full");

$product_attribute = json_decode(base64_decode($arrayInfoProduct['pro_picture_json']), 1);
$link_category     = createlink("category", array('nTitle'=> $arrayInfoProduct['cat_name']));

?>
<div class="inner-page-header">
    <div class="page-header-square"></div>
    <div class="page-lines">
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
    </div>
    <div class="page-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
      <a href="/" class="" itemprop="item">
        <span itemprop="name" style="opacity: 1">Trang chủ</span>
      </a>
        <meta itemprop="position" content="1">
        </span>
        <ul class="breadcrumb ng-isolate-scope">
            <li id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope"><?=$arrayInfoProduct['cat_name']?></span></li>
            <li id="bx_breadcrumb_1" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope"><?=$arrayInfoProduct['pro_name']?></span></li>
        </ul>
    </div>
    <div></div>
    <div class="container">
        <div class="page-header-title ">
            <h1><?=$arrayInfoProduct['pro_name']?></h1>
        </div>
    </div>
</div>

<div data-ui-view="residental-detail">
    <div class="">
        <div class="    ">
            <div class="container ">
                <div class=" slider_detail col-sm-8 row" style="position: relative; z-index: 999;float: none;margin: 20px auto;">
                    <div id="owl-demo" class="owl-carousel">
                        <?
                            $arrPicture = json_decode(base64_url_decode($arrayInfoProduct["pro_picture_json"]), true);

                            $i = 0;
                            foreach ($arrPicture as $key => $value) {
                                $i++;
                              $urlPicture = explode("_", $value['name']);
                              $urlPictureSmall = IMAGE_PATH_PRODUCT . "small/" . date("Y/m/", @intval($urlPicture[0])) . "small_" . $value['name'];
                              $urlPictureBig = IMAGE_PATH_PRODUCT . "full/" . date("Y/m/", @intval($urlPicture[0])) . $value['name'];
                              ?>
                              <div class="item"><center><img src="<?=$urlPictureBig?>"></center></div>
                            <?
                            }
                        ?> 
                      
                    </div>
                </div>
                <div class="row product-description">
					<?=$arrayInfoProduct['pro_description']?>
                </div>
            </div>
        </div>
        <div class="our-works ng-isolate-scope">
            <div class="container">
                <div class="filter-head margin-top-50">
                    <div class="main-about-text">
                        <h2 class="h1 gold"><?=$arrayInfoProduct['cat_name']?></h2>
                        <h3 class="white h3">Dự án liên quan</h3></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="container  portfolio-page">
                <div class="portfolio-list">
                    <div class="row  tile" id="portfolio-list">
						<?
						$db_pro_other = new db_query("SELECT * FROM products LEFT JOIN categories_multi ON cat_id = pro_category_id WHERE pro_id != " . $arrayInfoProduct['pro_id'] . " AND pro_category_id = " . $arrayInfoProduct['pro_category_id'] . " ORDER BY pro_id DESC LIMIT 3");
						while ($row_other = mysqli_fetch_assoc($db_pro_other->result)) {
							$pro_url         	= createlink('product_detail', array("nTitle"=> $row_other['pro_name'], "iData" =>$row_other['pro_id'] ));
							$picture_product 	= getUrlImageProduct($row_other['pro_picture'], "medium");
							?>
							<div class="col-sm-4" >
	                            <a href="<?=$pro_url?>"  title="<?=$row_other['pro_name']?>">
	                                <div class="portfolio-item-img">
	                                    <div class="blog-item-category hidden-xs"><?=$row_other['pro_name']?></div> <img src="<?=$picture_product?>" alt="<?=$row_other['pro_name']?>" /> </div>
		                                <div class="portfolio-item-info ">
		                                    <div class="portfolio-item-title"><span class="merriw"><?=$row_other['pro_name']?></span></div>
		                                    <div class="portfolio-item-params">
		                                        <div class="portfolio-item-square"><?=format_number($row_other['pro_mil'])?> м<sup>2</sup></div>
		                                        <div class="portfolio-item-style"><?=$row_other['cat_name']?></div>
		                                    </div>
		                                </div>
	                            </a>
	                        </div>
	                        <div class="clearfix ng-scope"></div>
							<?
						}
						unset($db_pro_other);
						?>
                    </div>
                </div>
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
        <div class="form-wrap margin-top-0 margin-bottom-150">
	      <form name="callback" class="page-bottom-form" method="post">
	          <div class="text-spec-block">
	              <h2 class="gold h1">Để lại liên hệ</h2>
	              <h3 class="h3 white">Chúng tôi sẽ gọi lại sớm cho bạn</h3></div>
	          <div class="form-fields">
	              <div class="row">
	                  <div class="col-sm-4">
	                      <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="name"                             type="text"                             id="page-35"                            required /><label class="input__label input__label--madoka" for="page-35"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Tên</span></label>
	                          </span>
	                      </div>
	                  </div>
	                  <div class="col-sm-4">
	                      <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="phone"                            id="page-36"                            type="text"                    required /><label class="input__label input__label--madoka" for="page-36"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Số điện thoại</span></label>
	                          </span>
	                      </div>
	                  </div>
	                  <input type="hidden" name="action" value="contact">
	                  <div class="col-sm-4">
	                      <div class="form-group">
	                          <div class="form-submit">
	                              <button type="submit" class="readmore-link">Gửi<span class="arr"></span></button>
	                          </div>
	                      </div>
	                  </div>
	              </div>
	           </div>
	          <div class="clearfix"></div>
	      </form>
	  </div>
    </div>
</div>
