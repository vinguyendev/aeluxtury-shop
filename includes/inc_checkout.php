<?
//goi thu vien
include('../classes/mail/class.smtp.php');
include "../classes/mail/class.phpmailer.php"; 
include "../classes/mail/functions.php"; 


$arrayProductInCart = $myshoppingcart->getArrayPoinCart();
$arrPaymentMethod	= array(0 => "COD", 1 => "Transfer");

$action             = getValue("action", "str", "POST", "");
$shipping_last_name = getValue("shipping_last_name", "str", "POST", "");
$billing_phone      = getValue("billing_phone", "str", "POST", "");
$shipping_email     = getValue("shipping_email", "str", "POST", "");
$shipping_address_1 = getValue("shipping_address_1", "str", "POST", "");
$order_comments     = getValue("order_comments", "str", "POST", "");
$ord_method_pay     = getValue("payment_method", "int", "POST", 0);
$shipping_city      = getValue("shipping_city", "int", "POST", 0);
$shipping_district  = getValue("shipping_district", "int", "POST", 0);
$strPaymentMethod	  = ($ord_method_pay == 1 ? "Transfer" : "COD");
$error              = "";
$payment = 0;
$htmlCart = '';
if($action == "cart"){

	if($shipping_last_name == ""){
		$error .= ' <p>Yêu cầu nhập họ và tên</p>';
	}
	if($billing_phone == ""){
		$error .= ' <p>Yêu cầu nhập số điện thoại</p>';
	}
	if($shipping_address_1 == ""){
		$error .= ' <p>Yêu cầu nhập địa chỉ</p>';
	}
	if($error == ""){

		$db_query = new db_query("SELECT * FROM products WHERE pro_id IN (" . convert_array_to_list(array_keys($arrayProductInCart)) . ")");

		$total_money    = 0;
		$db_insert      = new db_execute_return();
		$last_id    = $db_insert->db_execute("INSERT INTO orders (ord_name,ord_email,ord_address,ord_phone,ord_date,ord_method_pay,ord_city,ord_district,ord_note_customer)
			VALUES ('" . $shipping_last_name . "','" . $shipping_email . "','" . $shipping_address_1 . "','" . $billing_phone . "'," . time() . ",'" . $strPaymentMethod . "','" . $shipping_city . "','" . $shipping_district . "','" . $order_comments . "') ");
		unset($db_insert);
		while ($row = mysqli_fetch_assoc($db_query->result)) {

			$price_pro = $row['pro_price'];

			$total_money += $arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro;
			$db_in = new db_execute("INSERT INTO orders_detail (odd_order_id,odd_product_id,odd_quantity,odd_prices)
				VALUES (". $last_id .",". $row['pro_id'] .",". $arrayProductInCart[$row['pro_id']]['quantity'] .",". $row['pro_price'] .")");
			unset($db_in);
			$htmlCart .= '<tr>
					<td style="padding: 5px;">Tên SP</td>
					<td style="padding: 5px;"><b>' . $row['pro_name'] . '</b> : ' . $arrayProductInCart[$row['pro_id']]['quantity'] . ' x ' . format_number($row['pro_price']) . ' VNĐ</td>
				</tr>';
		}

		$db_update = new db_execute_return();
		$last_up_id = $db_update->db_execute("UPDATE orders SET ord_payment = ". $total_money ." WHERE ord_id = ".$last_id);
		unset($db_update);

		unset($db_query);
		if($last_id > 0){
			$title   = 'Đơn hàng MD-'.$last_id.' Thời gian: '. date("d/m/y H:i:s",time());
			$content = '<table border="1" cellspacing="5" cellspacing="5" style="border-collapse: collapse;">
				<tr>
					<td style="padding: 5px;">Mã ĐH</td>
					<td style="padding: 5px;">MD-'.$last_id.'</td>
				</tr>';
			$content .= $htmlCart;
			$content .=	'<tr>
					<td style="padding: 5px;">Tổng tiền:</td>
					<td style="padding: 5px;"><b>' . format_number($total_money) . ' VNĐ</b></td>
				</tr>
			</table>';
			$nTo     = 'Huudepzai';
			$mTo     = 'minhtranquang258@gmail.com';
			// $mTo     = $con_admin_email;
			$diachi  = 'teamcodevg@gmail.com';
			//test gui mail
			$mail = sendMail($title, $content, $nTo, $mTo, $diachicc='');
			// if($mail==1)
			// echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
			// else echo 'Co loi!';
			$remove_cart = $myshoppingcart->recount(2);
            // Nếu chọn thanh toán online thì bắn sang VTCPay để thanh toán
			// if($ord_method_pay == 1){
			// 	$destinationUrl	= "http://alpha1.vtcpay.vn/portalgateway/checkout.html";
			// 	$security			= "PaymentType:Visa;Direct:Master2018";
			// 	$urlReturn 			= "http://wetgicomestic.site/done.html";
			// 	$plaintext			= $total_money . "|VND|vi|0963465816|".$last_id."|" . $urlReturn . "|84181|" . $security;
			// 	$signature			= strtoupper(hash('sha256', $plaintext));

			// 	$data = "?url_return=" . $urlReturn . "&language=vi&website_id=84181&amount=" . $total_money . "&receiver_account=0963465816&reference_number=" . $last_id . "&currency=VND&signature=" . $signature;

			// 	$destinationUrl = $destinationUrl . $data;

			// 	redirect($destinationUrl);
			// 	exit();
			// }

			echo '<script type="text/javascript">
			alert("Cảm ơn bạn đã mua hàng! Chúng tối sẽ liên hệ lại với bạn trong thời gian sớm nhất!");
			window.location.href = "/";
			</script>';

		}
	}
}

$arrCity = array();
$db_query2 = new db_query("SELECT * FROM cities WHERE cit_active = 1 AND cit_parent_id = 0 ORDER BY cit_id ASC");
while ($row = mysqli_fetch_assoc($db_query2->result)) {
	$arrCity[$row['cit_id']] = $row['cit_name'];
}
unset($db_query2);
?>

<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
		<div class="main-content tie-col-md-8 tie-col-xs-12" role="main">
			<article id="the-post" class="container-wrapper post-content">
				<header class="entry-header-outer">
					<nav id="breadcrumb"><a href="/"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current">Thanh toán</span></nav>
					<div class="entry-header">
						<h1 class="post-title entry-title">Thanh toán</h1>
					</div>
				</header>
				<div class="entry-content entry clearfix">
					<div class="woocommerce">

						<form name="checkout" method="post" class="checkout woocommerce-checkout" action="" enctype="multipart/form-data">
							<input type="hidden" name="action" value="cart">
							<div class="col2-set" id="customer_details">
								<div class="col-1">
									<div class="woocommerce-billing-fields">
										<h3>Thông tin khách hàng</h3>
									</div>
									<div class="woocommerce-shipping-fields">
										<div class="shipping_address">
											<div class="woocommerce-shipping-fields__field-wrapper">
												<p class="form-row form-row-last validate-required" id="shipping_last_name_field" data-priority="20">
													<label for="shipping_last_name">Họ và tên <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " value="<?=$shipping_last_name?>" name="shipping_last_name" id="shipping_last_name" autocomplete="family-name" />
												</p>
												<p class="form-row form-row-wide" id="shipping_email_field" data-priority="30">
													<label for="shipping_email">Email</label>
													<input type="email" class="input-text " value="<?=$shipping_email?>" name="shipping_email" id="shipping_email" autocomplete="organization" />
												</p>
												<p class="form-row form-row-wide address-field validate-required" id="shipping_address_1_field" data-priority="50">
													<label for="shipping_city">Tỉnh/TP <abbr class="required" title="required">*</abbr></label>
													<select class="input-text" name="shipping_city" id="shipping_city" onchange="showDistrict();">
														<option value="0">- Chọn -</option>
														<?
														foreach ($arrCity as $key => $value) {
															$select = '';
															if($shipping_city == $key){
																$select = ' selected';
															}
															echo '<option value="' . $key . '" ' . $select . '>' . $value . '</option>';
														}
														?>
													</select>
												</p>
												<p class="form-row form-row-wide address-field validate-required" id="shipping_district" data-priority="50">

												</p>
												<p class="form-row form-row-wide address-field validate-required" id="shipping_address_1_field" data-priority="50">
													<label for="shipping_address_1">Địa chỉ <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " value="<?=$shipping_address_1?>" name="shipping_address_1" id="shipping_address_1" placeholder="Nhập đầy đủ chính xác địa chỉ của bạn" autocomplete="address-line1" />
												</p>
												<p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
													<label for="billing_phone">Số điện thoại <abbr class="required" title="required">*</abbr></label>
													<input type="tel" class="input-text " value="<?=$billing_phone?>" name="billing_phone" id="billing_phone" autocomplete="tel">
												</p>

											</div>
										</div>
									</div>
									<div class="woocommerce-additional-fields">
										<div class="woocommerce-additional-fields__field-wrapper">
											<p class="form-row notes" id="order_comments_field" data-priority="">
												<label for="order_comments">Ghi chú</label>
												<textarea name="order_comments" class="input-text " id="order_comments" placeholder="Nội dung" rows="2" cols="5"><?=$order_comments?></textarea>
											</p>
										</div>
									</div>
								</div>
							</div>
							<h3 id="order_review_heading">Thông tin đơn hàng</h3>
							<div id="order_review" class="woocommerce-checkout-review-order">
								<?=$myshoppingcart->getTemplateCart()?>

								<div id="payment" class="woocommerce-checkout-payment">
									<ul class="wc_payment_methods payment_methods methods">
										<li class="wc_payment_method payment_method_bacs">
											<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="0" checked='checked' data-order_button_text="" />
											<label for="payment_method_bacs"> <b>Thanh toán COD</b> </label>
											<div class="payment_box payment_method_bacs">
												<p>Giao hàng và thu tiền tại nhà</p>
											</div>
										</li>
										<!-- <li class="wc_payment_method payment_method_cheque">
											<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="1" data-order_button_text="" />
											<label for="payment_method_cheque"> <b>Thanh toán online</b> </label>
											<div class="payment_box payment_method_cheque">
												<p>Quý khách sẽ được chuyển đến VTCPay để thanh toán.</p>
											</div>
										</li> -->
									</ul>
									<div class="form-row place-order">

										<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>

									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</article>
			<div class="post-components"> </div>
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
				<div id="tie-weather-widget-13" class="widget tie-weather-widget">
					<div class="widget-title the-global-title">
						<h4>Thời tiết<span class="widget-title-icon fa"></span></h4>
					</div>
					<div id="tie-weather-cairo" class="weather-wrap is-animated">
						<a class="weatherwidget-io" href="https://forecast7.com/en/21d03105d83/hanoi/" data-label_1="HÀ NỘI" data-icons="Climacons Animated" data-days="5" data-theme="sky" data-basecolor="#0088ff" data-highcolor="#ffffff" data-lowcolor="#ffffff" ></a>
						<script type="text/javascript">
							jQuery(function(e){
								! function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (!d.getElementById(id)) {
										js = d.createElement(s);
										js.id = id;
										js.src = 'https://weatherwidget.io/js/widget.min.js';
										fjs.parentNode.insertBefore(js, fjs);
									}
								}(document, 'script', 'weatherwidget-io-js');
							})
						</script>
					</div>
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
<script type="text/javascript">
	$( document ).ready(function() {
		showDistrict();
	});

	function showDistrict() {
		var shipping_city = $("#shipping_city").val();
		shipping_city = parseInt(shipping_city);

		$.ajax({
			type: "POST",
			url: "/ajax/show_district.php",
			data: {shipping_city: shipping_city},
			success: function(data){
				$("#shipping_district").html(data.html)
				$("#text_ship").html(data.ship)
			},
			dataType: "json"
		});
	}
</script>
