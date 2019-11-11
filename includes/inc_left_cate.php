<aside class="sidebar tie-col-md-4 tie-col-xs-12 normal-side" aria-label="Primary Sidebar">
	<div class="theiaStickySidebar">
		<div id="woocommerce_product_search-3" class="container-wrapper widget woocommerce widget_product_search">
			<div class="widget-title the-global-title">
				<h4>Tìm kiếm sản phẩm<span class="widget-title-icon fa"></span></h4>
			</div>
			<form role="search" method="get" class="woocommerce-product-search">
				<label class="screen-reader-text" for="woocommerce-product-search-field-0">Search for:</label>
				<input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Tìm kiếm sản phẩm" value="<?=$keyword_pro?>" name="keyword_pro" />
				<button type="submit" value="Search">Search</button>

			</form>
			<div class="clearfix"></div>
		</div>
		<div id="woocommerce_product_categories-3" class="container-wrapper widget woocommerce widget_product_categories">
			<div class="widget-title the-global-title">
				<h4>Danh mục sản phẩm<span class="widget-title-icon fa"></span></h4>
			</div>
			<ul class="product-categories">
				<li class="cat-item cat-item-3"><a href="/category/san-pham-id3?promotion=1">Sản phẩm khuyến mãi</a></li>
				<?
				$db_cat = new db_query("SELECT * FROM categories_multi WHERE cat_active = 1 AND cat_type = 'product' ORDER BY cat_id ASC");
				while ($row_cat = mysqli_fetch_assoc($db_cat->result)) {
					$cat_url   = createlink('product', array('nTitle'=> $row_cat['cat_name'], 'iData' => $row_cat['cat_id']));
					echo '<li class="cat-item cat-item-207"><a href="' . $cat_url . '">' . $row_cat['cat_name'] . '</a></li>';
				}
				unset($db_cat);
				?>
			</ul>
			<div class="clearfix"></div>
		</div>
		<form method="get">
			<div id="woocommerce_price_filter-3" class="container-wrapper widget woocommerce widget_price_filter">
				<div class="widget-title the-global-title">
					<h4>Khoảng giá (VNĐ)<span class="widget-title-icon fa"></span></h4>
				</div>
				<div class="filter_price">
					<input type="text" id="filter_price" class="js-range-slider" name="filter_price" value="" />
					<input type="hidden" id="filter_price_min" name="filter_price_min" value="0" />
					<input type="hidden" id="filter_price_max" name="filter_price_max" value="10000000" />
				</div>
				<script type="text/javascript">
					$(function(){
						$("#filter_price").ionRangeSlider({
							skin: "round",
							step: 10,
							type: "double",
							min: 0,
							max: 3000000,
							from: <?=$filter_price_min?>,
							to: <?=$filter_price_max?>,
							drag_interval: true,
							min_interval: null,
							max_interval: null,
							onChange: function (data) {
								$("#filter_price_min").val(data.from);
								$("#filter_price_max").val(data.to);
							}
						});
					})
				</script>
				<br/>
				<div class="clearfix"></div>
				<div class="widget-title the-global-title">
					<h4>Dung lượng (ml)<span class="widget-title-icon fa"></span></h4>
				</div>
				<div class="filter_price">
					<input type="text" id="filter_capacity" class="js-range-slider" name="filter_capacity" value="" />
					<input type="hidden" id="filter_capacity_min" name="filter_capacity_min" value="0" />
					<input type="hidden" id="filter_capacity_max" name="filter_capacity_max" value="10" />
				</div>
				<script type="text/javascript">
					$(function(){
						$("#filter_capacity").ionRangeSlider({
							skin: "round",
							step: 100,
							type: "double",
							min: 0,
							max: 2000,
							from: <?=$filter_capacity_min?>,
							to: <?=$filter_capacity_max?>,
							drag_interval: true,
							min_interval: null,
							max_interval: null,
							onChange: function (data) {
								$("#filter_capacity_min").val(data.from);
								$("#filter_capacity_max").val(data.to);
							}
						});
					})
				</script>
				<style type="text/css">
				.woocommerce_brand_title{
					margin-top: 20px;
				}
				.woocommerce_brand{
					width: 100%;
				}
				.woocommerce_brand select{
					width: 100%;
				}
				</style>
				<div class="widget-title the-global-title woocommerce_brand_title">
					<h4>Thương hiệu</h4>
				</div>
				<div class="woocommerce_brand">
					<select name="brand" class="orderby">
						<option value="0">Thương hiệu</option>
						<?
						foreach ($arrSup as $key => $value) {
							$selected = "";
							if($key == $brand){
								$selected = " selected='selected'";
							}
							echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
						}
						?>
					</select>
				</div>
				<br/>
				<input type="hidden" name="orderby" value="<?=$orderby?>">
				<button type="submit">Tìm kiếm</button>
				<div class="clearfix"></div>
			</div>
		</form>
		<br/>
		<div id="woocommerce_products-3" class="container-wrapper widget woocommerce widget_products">
			<div class="widget-title the-global-title">
				<h4>Sản phẩm mới<span class="widget-title-icon fa"></span></h4>
			</div>
			<ul class="product_list_widget">
				<?
				$query  =  "SELECT *
								FROM products
								STRAIGHT_JOIN categories_multi ON (cat_id = pro_category_id)
								WHERE pro_active = 1 ORDER BY pro_id DESC LIMIT 5";
				$db_query = new db_query($query);
				while ($row = mysqli_fetch_assoc($db_query->result)) {
					$pro_url         = createlink('product_detail', array("nTitle"=> $row['pro_name'], "iData" =>$row['pro_id'] ));
					$picture_product = getUrlImageProduct($row['pro_picture'], "small");
					?>
					<li>
						<a href ="<?=$pro_url?>">
							<span class="img_pro_new"><img src="<?=$picture_product?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-img wp-post-image" alt="" data-src="<?=$picture_product?>" /></span>
							<span class="product-title"><?=$row['pro_name']?></span>
						</a>
						<span class="price"><span class="woocommerce-Price-amount amount"><?=($row['pro_price'] > 0 ? format_number($row['pro_price']) . " VNĐ" : "Liên hệ") ?></span></span>
					</li>
					<?
				}
				unset($db_query);
				?>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
</aside>