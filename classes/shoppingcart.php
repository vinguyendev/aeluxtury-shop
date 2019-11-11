<?
class shoppingcart{
	//Giá trị hiện hành của giỏ hàng
	var $current_cart			= array();
	var $server_name			= "";

	public function __construct(){
      $this->shoppingcart();
   }
	/*
	Khởi tạo shopping cart
	$con_currency : Tỉ giá
	*/
	function shoppingcart(){
		//check cookie
		if (isset($_COOKIE["estore"])) $this->current_cart = @json_decode(@base64_decode($_COOKIE["estore"]), 1);
		//Nếu ko phải dạng array thì reset lại giỏ hàng
		if (!is_array($this->current_cart)){
			$this->current_cart = array();
			$this->clearCoookie();
			if(isset($_COOKIE["estore"])) unset($_COOKIE["estore"]);
		}
	}

	/**
	 * Function đưa 1 san pham vao gio hang
	 * shoppingcart::addtocart()
	 *
	 * @param mixed $pro_id     : ID product
	 * @param mixed $quantity   : So luong
	 * @param integer $received : 0->nhan hang tai dia chi dang ky, 1 nhan hang tai quay
	 * @return
	 */
	function addtocart($pro_id, $quantity){

		$return	= 0;

		// Kiểm tra SP này đã có trong giỏ hàng hay chưa, có rồi return luôn
		//if($this->check_product_incart($pro_id)) return 1;

		if($quantity > 0){

			$this->current_cart[$pro_id]['quantity'] = $quantity;
			// $this->current_cart[$pro_id]['color']    = $color;
			// $this->current_cart[$pro_id]['size']     = $size;
			//Save cookie
			$this->saveCookie();
			$return	= 1;
		}

		return $return;
	}

	/**
	 * Kiem tra xem san pham nay co trong cart chua
	 * shoppingcart::check_product_incart()
	 *
	 * @param mixed $pro_id
	 * @return void
	 */
	function check_product_incart($pro_id){

		if(isset($this->current_cart[$pro_id])) return 1;
		return 0;
	}

	/**
	 * Tra ve so luong cua san pham trong don hang
	 * shoppingcart::getQuantityDealInCart()
	 *
	 * @param mixed $pro_id : ID product
	 * @return
	 */
	function getQuantityDealInCart($pro_id){

		if(isset($this->current_cart[$pro_id]['quantity'])) return $this->current_cart[$pro_id]['quantity'];
		return 0;
	}

	/**
	 * Lay cac san pham trong gio hàng theo khu vuc(bao gom san pham mua ngay va san pham cho thanh toan)
	 * shoppingcart::getArrayPoinCartInEstore()
	 * @return void
	 */
	function getArrayPoinCart(){

		$array_return	= ($this->current_cart) ? $this->current_cart : array();

		// Đưa các sản phẩm mua sau lên trước
		if($array_return)		$array_return	= array_reverse($array_return, true);

		return $array_return;
	}

	/*
	Recount product
	*/
	/**
	 * shoppingcart::recount()
	 *
	 * @param integer $clear     : 0->recount product, 1->xoa 1 product, 2->xoa gio hang
	 * @param integer $product_id   : ID sản phẩm
	 * @param integer $quantity  : So luong moi
	 * @return void
	 */
	function recount($clear = 0, $product_id = 0, $quantity = 0){

		$clear 		= getValue("clear", "int", "GET", $clear);

		switch ($clear){

			// Xóa 1 sản phẩm
			case 3:
				if($this->current_cart){
					foreach ($this->current_cart as $key => $value){
						$deleteopt = "delete_" . $key;
						// Nếu đây là sản phẩm cần xóa(truyền theo GET hoặc trực tiếp)
						if (isset($_GET[$deleteopt]) || $key == $product_id){
							unset($this->current_cart[$key]);
						}
					}
				}
				break;

			//Clear all
			case 2:
				$this->current_cart = array();
				break;

			//Recount lại 1 sản phẩm
			default:
				//Nếu tồn tại cookie của cửa hàng bắt đầu count lại
				if($this->current_cart){
					foreach($this->current_cart as $key => $value){

						$nQuantity		= 0;
						$nQuantity		= getValue("quantity_". $key, "int", "POST", $value['quantity']);

						// Trường hợp recount 1 sản phẩm theo id truyền vào
						if($key == $product_id && $product_id > 0){
							$nQuantity	= $quantity;
						}

						if ($nQuantity < 0) $nQuantity	= 0;

						if ($nQuantity > 0){
							$this->current_cart[$key]['quantity']	= $nQuantity;
						}
					}
				}
				break;
		}

		//Save lại cookie
		$this->saveCookie();
	}

	/**
	 * Dem so san pham trong gio hang
	 * shoppingcart::count_product()
	 *
	 * @return
	 */
	function count_product(){
		return count($this->current_cart);
	}

	function getTemplateCart(){

		$html 	= "";
		$arrayProductInCart 	= $this->getArrayPoinCart();

		if(!$arrayProductInCart){
			$html = '<p style="padding:10px;" >Bạn chưa có sản phẩm nào trong giỏ hàng. </p>';
			return $html;
		}
		$db_query	= new db_query("SELECT * FROM products WHERE pro_id IN (" . convert_array_to_list(array_keys($arrayProductInCart)) . ")");
		$html 	.= '<table class="shop_table woocommerce-checkout-review-order-table">
									<thead>
										<tr>
											<th class="product-name">Thông tin sản phẩm</th>
											<th class="product-total">Total</th>
										</tr>
									</thead>
									<tbody>';
        $stt_product 	= 0;
		$total_money	= 0;
        while ($row = mysqli_fetch_assoc($db_query->result)) {
			$stt_product++;
			$price_pro = $row['pro_price'];

			$bg_color 		=  ($stt_product % 2) == 0 ? '#FFFFFF' : '#f7f7f7';
			$total_money	+= $arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro;
            $linkProduct = createlink("product_detail", array("iData" => $row['pro_id'], "nTitle" => $row['pro_name']));
            $urlPicture     = $url_image = getUrlImageProduct($row['pro_picture'], "small");
            $html .= '<tr class="cart_item">
						<td class="product-name"><img style="width:50px;vertical-align: middle;" src="' . $urlPicture . '" > &nbsp;<a href="' . $linkProduct . '">' . $row['pro_name'] . '</a>&nbsp; <strong class="product-quantity">&times; <input type="text" class="txtQty-cart" style="width:35px" title="Thay đổi số lượng nếu bạn muốn" placeholder="Số lượng" onchange="recountCart(' . $row['pro_id'] . ', $(this).val());" name="quantity_' . $row['pro_id'] . '" id="quantity_' . $row['pro_id'] . '" min="1" max="10000" aria-valuemin="1" aria-valuemax="10000" value="' . $arrayProductInCart[$row['pro_id']]['quantity'] . '" /></strong>
						<a onclick="javascript:if(confirm(\'Bạn có muốn xóa sản phẩm này không?\')){ recountCart(' . $row['pro_id'] . ',0,\'delete\'); }" title="Xoá khỏi giỏ hàng?" class="lnk-cart-item-rem"  title="Bỏ sản phẩm"><i class="fa fa-trash-o"></i></a></td>
						<td class="product-total"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>' . format_number($arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro) . ' VNĐ</span>
						</td>
					</tr>';
      	}

        $html .='</tbody>
					<tfoot>
						<tr class="cart-subtotal">
							<th>Tổng tiền</th>
							<td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>' . format_number($total_money) . ' VNĐ</span>
							</td>
						</tr>
						<tr class="shipping">
							<th>Vận chuyển</th>
							<td data-title="Shipping">
								<div id="text_ship" class="tie-popup-trigger"> Liên hệ
									<input type="hidden" name="shipping_method[0]" data-index="0" id="shipping_method_0" value="free_shipping:1" class="shipping_method" />
								</div>
							</td>
						</tr>
						<tr class="order-total">
							<th>Tổng thanh toán</th>
							<td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>' . format_number($total_money) . ' VNĐ</span></strong> </td>
						</tr>
					</tfoot>
				</table>';
		return $html;
	}

	function getTemplateMiniCart(){
		$html 	= "";
		$total_money	= 0;
		$arrayProductInCart 	= $this->getArrayPoinCart();
		$db_query	= new db_query("SELECT * FROM products WHERE pro_id IN (" . convert_array_to_list(array_keys($arrayProductInCart)) . ")");
		echo '<ul class="cart-list">';
		while ($row = mysqli_fetch_assoc($db_query->result)) {
			$price_pro = $row['pro_price'];
			$total_money	+= $arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro;
            $linkProduct = createlink("product_detail", array("iData" => $row['pro_id'], "nTitle" => $row['pro_name']));
            $urlPicture     = $url_image = getUrlImageProduct($row['pro_picture'], "small");

        	// $html 	.= '<li class="row cart-item">
         //                <div class="col cart-item1 product">
         //                    <img src="' . $urlPicture . '">
         //                </div>
         //                <div class="col cart-item2 product"><a href="' . $linkProduct . '">' . $row['pro_name'] . '</a></div>
         //                <div class="col cart-item3 product">' . format_number($price_pro) . '  đ</div>
         //                <div class="col cart-item4 product">x ' . $arrayProductInCart[$row['pro_id']]['quantity'] . '</div>
         //                <div class="col cart-item5 product"><a onclick="javascript:if(confirm(\'Bạn có muốn xóa sản phẩm này không?\')){ recountCart(' . $row['pro_id'] . ',0,\'delete\'); }" class="cart-item-remove" data-record="515593" title="Bỏ khỏi giỏ hàng"><i class="fa fa-trash-o"></i></a></div>
         //            </li>';
            $html .= '<li>
                        <div class="product-thumb">
                          <a href="' . $linkProduct . '"><img data-old="' . $urlPicture . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-img wp-post-image" alt="" src="' . $urlPicture . '"></a>
                        </div>
                        <h3 class="product-title"><a href="' . $linkProduct . '">' . $row['pro_name'] . '</a></h3>
                        <div class="product-meta">
                          <div class="product-price">Giá: <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>' . format_number($arrayProductInCart[$row['pro_id']]['quantity'] * $price_pro) . ' VNĐ</span></div>
                          <div class="product-quantity">Số lượng: ' . $arrayProductInCart[$row['pro_id']]['quantity'] . '</div>
                        </div>
                        <a onclick="javascript:if(confirm(\'Bạn có muốn xóa sản phẩm này không?\')){ recountCart(' . $row['pro_id'] . ',0,\'delete\'); }" class="remove"><span class="screen-reader-text">Xóa</span></a>
                      </li>';
        }
        $html .= '</ul>
                    <div class="shopping-subtotal">
                      <span class="tie-alignleft">Tổng tiền:</span><span class="tie-alignright"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>' . format_number($total_money) . ' VNĐ</span></span>
                    </div>';

		return $html;
	}
	/*
	save cookie
	*/
	function saveCookie(){
		$cookieData	= base64_encode(json_encode($this->current_cart));
		//Set temporary cookie
		setcookie("estore", $cookieData, null, "/", $this->server_name, null, 1);
		setcookie("estore", $cookieData, null, "/", "", null, 1);
	}

	/**
	 * Xóa thông tin giỏ hàng
	 * shoppingcart::clearCoookie()
	 *
	 * @return void
	 */
	function clearCoookie(){
		setcookie("estore", "", null, "/", $this->server_name, null, 1);
		setcookie("estore", "", null, "/", "", null, 1);
	}
}
?>