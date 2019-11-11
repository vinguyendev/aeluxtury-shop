<?
$arrayProductInCart = $myshoppingcart->getArrayPoinCart();

?>
<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
		<div class="main-content tie-col-md-12" role="main">
			<article id="the-post" class="container-wrapper post-content">
				<header class="entry-header-outer">
					<nav id="breadcrumb"><a href="/"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current">Giỏ hàng</span></nav>

					<div class="entry-header">
						<h1 class="post-title entry-title">Giỏ hàng</h1>
					</div>
				</header>
				<div class="entry-content entry clearfix">
					<div class="woocommerce">
						<form class="woocommerce-cart-form" action="./" method="post">
							<div class="table-is-responsive">
								<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
									<thead>
										<tr>
											<th class="product-remove">&nbsp;</th>
											<th class="product-thumbnail">&nbsp;</th>
											<th class="product-name">Sản phẩm</th>
											<th class="product-price">Giá tiền</th>
											<th class="product-quantity">Số lượng</th>
											<th class="product-subtotal">Tổng tiền</th>
										</tr>
									</thead>
									<tbody>
										<?
										$total_money	= 0;
										$db_query	= new db_query("SELECT * FROM products WHERE pro_id IN (" . convert_array_to_list(array_keys($arrayProductInCart)) . ")");
										while ($row = mysqli_fetch_assoc($db_query->result)) {
											$price_pro = $row['pro_price'];
											$total_money += $arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro;
											$linkProduct = createlink("product_detail", array("iData" => $row['pro_id'], "nTitle" => $row['pro_name']));
											$urlPicture  =  getUrlImageProduct($row['pro_picture'], "small");
										?>
										<tr class="woocommerce-cart-form__cart-item cart_item">
											<td class="product-remove"> <a onclick="javascript:if(confirm('Bạn có muốn xóa sản phẩm này không?')){ recountCart(<?=$row['pro_id'] ?>,0,'delete'); }" class="remove" aria-label="Remove this item" data-product_id="404" data-product_sku="tie-s-r">×</a> </td>
											<td class="product-thumbnail"><a href="<?=$linkProduct?>"><img src="<?=$urlPicture?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-img wp-post-image" alt="" style="display: inline;"></a></td>
											<td class="product-name" data-title="Product"><a href="<?=$linkProduct?>"><?=$row['pro_name']?></a></td>
											<td class="product-price" data-title="Price"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?= format_number($price_pro)?></span> </td>
											<td class="product-quantity" data-title="Quantity">
												<div class="quantity"> <label class="screen-reader-text" for="quantity_5bbed78f525d6">Quantity</label> <input onchange="recountCart(<?=$row['pro_id']?>, $(this).val());" name="quantity_<?=$row['pro_id']?>" id="quantity_<?=$row['pro_id']?>" type="number"  class="input-text qty text" step="1" min="0" value="<?=$arrayProductInCart[$row['pro_id']]['quantity']?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Black T-shirt quantity"> </div>
											</td>
											<td class="product-subtotal" data-title="Total"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?= format_number($arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro) ?> VNĐ</span> </td>
										</tr>
										<?
										}
										unset($db_query);
										?>

									</tbody>
								</table>
							</div>
						</form>
						<div class="cart-collaterals">
							<div class="cart_totals ">
								<h2>Tổng giỏ hàng</h2>
								<div class="table-is-responsive">
									<table cellspacing="0" class="shop_table shop_table_responsive">
										<tbody>
											<tr class="cart-subtotal">
												<th>Tổng tiền</th>
												<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?= format_number($total_money) ?> VNĐ</span></td>
											</tr>
											<tr class="shipping">
												<th>Phí vận chuyển</th>
												<td data-title="Shipping">

													Liên hệ

												</td>
											</tr>
											<tr class="order-total">
												<th>Tổng tiền thanh toán</th>
												<td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?= format_number($total_money) ?> VNĐ</span></strong> </td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="wc-proceed-to-checkout"> <a href="/checkout.html" class="checkout-button button alt wc-forward">Thanh toán</a> </div>
							</div>
						</div>
					</div>
				</div>
			</article>
			<div class="post-components"> </div>
		</div>
	</div>
</div>