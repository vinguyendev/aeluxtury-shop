<? 
$arrayListProduct   = getListProduct(3,0,12,' AND pro_name LIKE "%'. $keyword .'%" ');
?>
<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
	    <div class="main-content tie-col-md-8 tie-col-xs-12" role="main">
	        <header class="entry-header-outer container-wrapper">
	            <nav id="breadcrumb"><a href="/index.html"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current">Tìm kiếm</span></nav>
	        </header>
	        <div class="mag-box wide-post-box">
	            <div class="container-wrapper">
	                <div class="mag-box-container clearfix">
	                    <ul class="products columns-3">
                      <?
                      $i = 1;
                      foreach ($arrayListProduct as $key => $value) {
                        $strOnOff        = checkOnOff($value["pro_onl_off"]);
                        $pro_url         = createlink('product_detail', array("nTitle"=> $value['pro_name'], "iData" =>$value['pro_id'] ));
                        $picture_product = getUrlImageProduct($value['pro_picture'], "medium");
                        // $cat_url         = createlink('category', array('nTitle'=> $value['cat_name']));
                        $class = '';
                        if($i == 1 || $i == 4 || $i == 7 || $i == 10 ){
                          $class = ' first';
                        }elseif($i == 3 || $i == 6 || $i == 9 || $i == 12){
                          $class = ' last';
                        }
                        ?>
                        <li class="post-401 product type-product status-publish has-post-thumbnail product_cat-pants product_tag-color product_tag-men product_tag-pants <?=$class?> instock shipping-taxable purchasable product-type-simple">
                          <a href="<?=$pro_url?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                            <div class="product-img">
                              <?=$strOnOff?>
                              <img src="<?=$picture_product?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-img wp-post-image" alt="" data-src="<?=$picture_product?>" />
                            </div>
                            <h2 class="woocommerce-loop-product__title"><?=$value['pro_name']?></h2>
                            <span class="price"><span class="woocommerce-Price-amount amount"><?=($value['pro_price'] > 0 ? format_number($value['pro_price']) . " VNĐ" : "Liên hệ") ?></span></span>
                          </a>
                          <?
                          if($value["pro_onl_off"] > 0){
                            ?>
                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" onclick="addProductToCart(<?=$value['pro_id']?>,1);"  aria-label="Add &ldquo;3/4 Pant&rdquo; to your cart" rel="nofollow">Thêm vào giỏ hàng</a>
                            <?
                          }
                          ?>
                        </li>
                        <?
                        $i++;
                      }
                      ?>
                    </ul>
	                    <div class="clearfix"></div>
	                </div>
	            </div>
	        </div>
	       
	    </div>
	    <aside class="sidebar tie-col-md-4 tie-col-xs-12 normal-side is-sticky" aria-label="Primary Sidebar">
          <div class="theiaStickySidebar">
            <div id="social-statistics-21" class="container-wrapper widget social-statistics-widget">
              <div class="widget-title the-global-title">
                <h4>THƯƠNG HIỆU</h4>
              </div>
              <ul class="solid-social-icons two-cols transparent-icons Arqam-Lite">
                <?
                $db_ban = new db_query("SELECT * FROM brands WHERE bra_active = 1 ORDER BY bra_order ASC");
                while ($row = mysqli_fetch_assoc($db_ban->result)) {
                  ?>
                  <li class="social-icons-item">
                    <a href="<?=$row['bra_link']?>" rel="nofollow" target="_blank">
                      <img src="/data/brands/<?=$row['bra_picture']?>" alt="<?=$row['bra_name']?>">
                    </a>
                  </li>
                  <?  
                }
                unset($db_ban);
                ?>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="container-wrapper tabs-container-wrapper tabs-container-3">
              <div class="widget tabs-widget">
                <div class="widget-container">
                  <div class="tabs-widget">
                    <div class="tabs-wrapper">
                      <ul class="tabs">
                        <!-- <li><a href="#widget_tabs-11-recent">Tin mới</a></li> -->
                        <li><a href="#widget_tabs-11-popular">Tin xem nhiều</a></li>
                      </ul>
                      <div id="widget_tabs-11-popular" class="tab-content tab-content-recent">
                        <ul class="tab-content-elements">
                          <?
                          $db_query = new db_query("SELECT * FROM news_multi WHERE new_active = 1 AND new_hot = 1 ORDER BY new_id DESC LIMIT 3");
                            while ($row = mysqli_fetch_assoc($db_query->result)) {
                              $news_pic   = getUrlImageNews($row['new_picture'],"");
                              $array_info = array("nTitle" => $row['new_title'], "iData" => $row['new_id']);
                              $news_url   = createlink('news_detail', $array_info);
                              echo '<li class="widget-post-list is-trending tie-video">
                                <div class="post-widget-thumbnail">
                                  <a href="' . $news_url . '" title="' . $row['new_title'] . '" class="post-thumb">
                                    <div class="post-thumb-overlay-wrap">
                                      <div class="post-thumb-overlay"> <span class="icon"></span> </div>
                                    </div>
                                    <img width="220" height="150" src="' . $news_pic . '" class="attachment-jannah-image-small size-jannah-image-small lazy-img tie-small-image wp-post-image" alt="" data-src="' . $news_pic . '" />
                                  </a>
                                </div>
                                <div class="post-widget-body ">
                                  <h3 class="post-title"><a href="' . $news_url . '" title="' . $row['new_title'] . '">' . $row['new_title'] . '</a></h3>
                                  <div class="post-meta"> <span class="date meta-item"><span class="fa fa-clock-o" aria-hidden="true"></span> <span>' . date("d/m/Y",$row['new_date']) . '</span></span>
                                  </div>
                                </div>
                              </li>';
                            }
                          unset($db_query);
                          ?>

                        </ul>
                      </div>
                 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </aside>
	</div>
	</div>