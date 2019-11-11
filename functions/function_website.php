<?
function cut_string2($str, $length, $char="..."){
	//Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
	$strlen	= mb_strlen($str, "UTF-8");
	if($strlen <= $length) return $str;

	//Cắt chiều dài chuỗi $str tới đoạn cần lấy
	$substr	= mb_substr($str, 0, $length, "UTF-8");
	if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;

	//Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
	$strPoint= mb_strrpos($substr, " ", "UTF-8");

	//Return string
	if($strPoint < $length - 20) return $substr . $char;
	else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
}

function getUrlImageNews($picture = "", $type = "")
{
    $url = IMAGE_PATH_NEW;
    $folder = "";
    switch ($type) {
        case 'medium':
            $url .= "medium/";
            $folder = "medium_";
            break;
        case 'small':
            $url .= "small/";
            $folder = "small_";
            break;
        default:
            $url .= "";
            break;
    }
    // Tách lấy tên thư mục
    // $dataPic = explode("_", $picture);

    // if (isset($dataPic['0'])) {
    //     $url .= date("Y/m/", intval($dataPic['0']));
    // }
    $url .= $folder . $picture;

    return $url;
}
function getListMethodPay(){
	global $con_address;
	$array_method_pay 	= array(	1 => array("title" => "Thanh toán tại văn phòng BLUETOUR", "description" => "<p>- Hình thức thanh toán được sử dụng nhiều nhất</p><p>- Chỉ thanh toán khi đã nhận được hàng</p>"),
											2 => array('title' => "Thu tiền tận nơi", "description" => "<p>- Quý khách sẽ đến cửa hàng nhận sản phẩm và thanh toán</p><p>- Địa chỉ: " . $con_address . "</p>"),
											3 => array("title" => "Chuyển khoản ngân hàng", "description" => "<p>-Quý khách có thể thanh toán cho chúng tôi bằng cách chuyển khoản trực tiếp tại ngân hàng, chuyển qua thẻ ATM, hoặc qua Internet banking.</p>")
									);
	return $array_method_pay;
}
/**
 * Function tra ve danh sach banner
 * getBanner()
 *
 * @param integer $list_position	Vi tri (1->Banner top, 2->Banner left, 3->Banner right", 4->Banner bottom, 5->Banner category, 6->Banner slibar)
 * @param integer $type			Loai banner (1->Banner Anh, 2->Banner Flash, 3->Banner HTML)
 * @param integer $active
 * @param integer $banner_id	ID banner
 * @param integer $ban_page	Page hien thi 0 -> All, 1 -> Trang chu, 2 -> Trang danh muc, 3 -> Trang season, 4 -> Trang chi tiet
 * @return
 */
function getBanner($list_position = 0, $type = 0, $active = 1, $banner_id = 0, $limit = 0){

	$array_return	= array();
	$sqlWhere		= " 1";
	$banner_id		= intval($banner_id);
	if($banner_id > 0){
		$sqlWhere		.= " AND ban_id = " . $banner_id;
	}

	if($list_position != ""){
		$list_position		= convert_list_to_list_id($list_position);
		$sqlWhere	.= " AND ban_position IN(" . $list_position . ")";
	}

	$type				= intval($type);
	if($type > 0) $sqlWhere	.= " AND ban_type = " . $type;

	$active		= intval($active);
	if($active == 1 || $active == 0)	$sqlWhere	.= " AND ban_active = " . $active;

	$sql_limit = '';
	if($limit > 0){
		$sql_limit =  " LIMIT " . $limit;
	}

	$db_query	= new db_query("	SELECT *
											FROM banners
											WHERE " . $sqlWhere . "
											ORDER BY ban_order ASC, ban_id DESC " . $sql_limit,
											"File: " . __FILE__ . ". Line :" . __LINE__);
	while($row	= mysqli_fetch_assoc($db_query->result)){
		if($row['ban_end_time'] == 0){
			// nếu là banner không set thời gian kết thúc
			$array_return[$row['ban_id']]	= $row;
		}else{
			// nếu banner đc set thời gian kết thúc thì kiểm tra điều kiện thời gian
			if($row['ban_end_time'] >= time()){
				$array_return[$row['ban_id']]	= $row;
			}
		}
	}
	unset($db_query);

	return $array_return;
}

/**
 * [getMenu Function lay danh sach menu]
 * @param  integer $postion [vi tri menu 0: tat ca, 1: menu top, 2: menu footer]
 * @param  integer $active  [trang thai 1: active, 0: unactive, -1: tat ca]
 * @return [type]           [mang cac menu]
 */
function getMenu($postion = 0, $active = 1, $parent_id = -1){
	$array_return 	= array();
	$sqlWhere 		= "";

	$postion 		= intval($postion);
	$active 			= intval($active);
	// Search theo vị trí
	if($postion > 0) $sqlWhere	.= " AND mnu_position = " . $postion;
	if($active >= 0) $sqlWhere	.= " AND mnu_active 	= " . $active;
	if($parent_id >= 0) $sqlWhere .= " AND mnu_parent_id = " . $parent_id;

	$query 		= "SELECT * FROM menus WHERE 1 " . $sqlWhere . " ORDER BY mnu_order ASC, mnu_id DESC";
	$db_query 	= new db_query($query);
	while ($row = mysqli_fetch_assoc($db_query->result)){
		$array_return[$row['mnu_id']]	= $row;
	}
	unset($db_query);

	return $array_return;
}

function checkOnOff($status){
	$strReturn = "";
	if($status > 0) $strReturn = '<span class="icon_buy buy_online">Bán online</span>';
	else $strReturn = '<span class="icon_buy buy_offline">Bán offline</span>';
	return $strReturn;
}

function getUrlImageAlbum($picture = "", $type = "")
{
    $url = IMAGE_PATH_ALBUM;
    $folder = "";
    switch ($type) {
        case 'medium':
            $url .= "medium/";
            $folder = "medium_";
            break;
        case 'small':
            $url .= "small/";
            $folder = "small_";
            break;
        default:
            $url .= "full/";
            break;
    }
    // Tách lấy tên thư mục
    $dataPic = explode("_", $picture);

    if (isset($dataPic['0'])) {
        $url .= date("Y/m/", intval($dataPic['0']));
    }
    $url .= $folder . $picture;

    return $url;
}


function getUrlImageProduct($picture = "", $type = "medium")
{
    $url = IMAGE_PATH_PRODUCT;
    $folder = "";
    switch ($type) {
        case 'medium':
            $url .= "medium/";
            $folder = "medium_";
            break;
        case 'small':
            $url .= "small/";
            $folder = "small_";
            break;
        default:
            $url .= "full/";
            break;
    }
    // Tách lấy tên thư mục
    $dataPic = explode("_", $picture);

    if (isset($dataPic['0'])) {
        $url .= date("Y/m/", intval($dataPic['0']));
    }
    $url .= $folder . $picture;

    return $url;
}

function getUrlImageFeedback($picture = "", $type = "medium")
{
    $url = IMAGE_PATH_FEED;
    $folder = "";
    switch ($type) {
        case 'medium':
            $url .= "medium/";
            $folder = "medium_";
            break;
        case 'small':
            $url .= "small/";
            $folder = "small_";
            break;
        default:
            $url .= "full/";
            break;
    }
    // Tách lấy tên thư mục
    $dataPic = explode("_", $picture);

    if (isset($dataPic['0'])) {
        // $url .= date("Y/m/", intval($dataPic['0']));
    }
    $url .= $folder . $picture;

    return $url;
}

function getUrlImageProject($picture = "", $type = "medium")
{
    $url = IMAGE_PATH_PROJECT;
    $folder = "";
    switch ($type) {
        case 'medium':
            $url .= "medium/";
            $folder = "medium_";
            break;
        case 'small':
            $url .= "small/";
            $folder = "small_";
            break;
        default:
            $url .= "/";
            break;
    }
    // Tách lấy tên thư mục
    $dataPic = explode("_", $picture);

    // if (isset($dataPic['0'])) {
    //     $url .= date("Y/m/", intval($dataPic['0']));
    // }
    $url .= $folder . $picture;

    return $url;
}
/**
 * Hàm lấy thông tin của category, có sử dụng memcache
 * getInfoCategory()
 *
 * @param mixed $cat
 * @return
 */
function getInfoCategory($iCat){

	$array_return 	= array();
	$iCat				= intval($iCat);
	if($iCat <= 0) return $array_return;

	// Lấy từ db
	$db_query	= new db_query("	SELECT *
											FROM categories_multi
											WHERE cat_id = " . $iCat,
											"FILE: " . __FILE__ . ", LINE: " . __LINE__);
	if($row = mysqli_fetch_assoc($db_query->result)){
		$array_return	= $row;
	}
	$db_query->close();
	unset($db_query);

	return $array_return;
}

function getListcategory($type = "", $parent_id = 0){
	$array_return 	= array();
	$sqlWhere = '';
	if($parent_id > 0){
		$sqlWhere .= " AND cat_parent_id = " . $parent_id;
	}
	// Lấy từ db
	$db_query	= new db_query("	SELECT *
											FROM categories_multi
											WHERE cat_type  = '" . $type . "' ". $sqlWhere,
											"FILE: " . __FILE__ . ", LINE: " . __LINE__);
	while($row = mysqli_fetch_assoc($db_query->result)){
		$array_return[$row['cat_id']]	= $row;
	}
	$db_query->close();
	unset($db_query);

	return $array_return;
}

function getListProduct($categoryID = 0, $start = 0, $limit = 0, $sqlWhere = "", $orderBy = ""){
	$categoryID	= intval($categoryID);
	$start		= intval($start);
	if($start <= 0) $start = 0;
	if($limit <= 0) $limit = 0;
	$limit 		= intval($limit);
	$sqlWhere 	= replaceMQ($sqlWhere);
	$orderBy		= replaceMQ($orderBy);

	$arrayReturn	= array();
	if($categoryID > 0){
		$InfoCat		= getInfoCategory($categoryID);
		$listCat		= isset($InfoCat['cat_all_child']) ? convert_list_to_list_id($InfoCat['cat_all_child']) : $categoryID;
		$sqlWhere	.= " AND pro_category_id IN(" . $listCat . ")";
	}

	$sqlOrder 	= " ORDER BY pro_order ASC, pro_id DESC";

	// Gán lại sql order nếu truyền trực tiếp
	if($orderBy != "") $sqlOrder	= $orderBy;

	if($orderBy == 'none_order') $sqlOrder 	= "";

	$sqlLimit 	= "";
	if($limit > 0) $sqlLimit	= " LIMIT " . $start . "," . $limit;

	$query	=	"SELECT *
					FROM products
					STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
					WHERE pro_active = 1 " . $sqlWhere . $sqlOrder . $sqlLimit;

	$db_query	= new db_query($query);
	while($row	= mysqli_fetch_assoc($db_query->result)){
		$arrayReturn[$row["pro_id"]] = $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}

/**
 *
 */
function getInfoProduct($productId){
	$productId		= intval($productId);
	$arrayReturn 	= array();
	if($productId <= 0) return $arrayReturn;

	$query 		= "SELECT products.*,categories_multi.* FROM products
						STRAIGHT_JOIN categories_multi ON(cat_id = pro_category_id)
						
						WHERE pro_id = " . intval($productId);

	$db_query 	= new db_query($query);
	if($row = mysqli_fetch_assoc($db_query->result)){
		$arrayReturn	= $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}

function showListProduct($arrayData = array(), $classAdd = "", $type="home"){
	global $arrayAttributeProduct;
	$htmlReturn 	= "";
	if(!isset($arrayData['pro_id'])) return $htmlReturn;

	$product_attribute 	= json_decode(base64_decode($arrayData['pro_attribute_data']), 1);
	$html_attribute 		= "";
	if(is_array($product_attribute)){
		$stt_attribute = 0;
		foreach ($product_attribute as $key => $value) {
			if($stt_attribute < 4 && $value != "" && isset($arrayAttributeProduct[$key]) && $arrayAttributeProduct[$key]['pra_show_home'] == 1){
				$stt_attribute++;
				$icon 	= "<div class='attribute_icon fl'></div>";
				if($arrayAttributeProduct[$key]['pra_icon_img'] != ""){
					$icon 	= "<div class='attribute_icon fl'><img src='" . PICTURE_PATH . "category/" . $arrayAttributeProduct[$key]['pra_icon_img'] . "'></div>";
				}
				$html_attribute 	.= '<div class="attribute_item">
												' . $icon . '
												<div class="attribute_name fl">' . $arrayAttributeProduct[$key]['pra_name'] . '<span class="space">:&nbsp;</span></div>
												<div class="attribute_value bold fl">' . $value . '</div>
												<div class="clear"></div>
											</div>';
			}
		}
	}
	$linkProduct 	= createlink("product", array("iData" => $arrayData['pro_id'], "nTitle" => $arrayData['pro_short_name']));
	$imageProduct 	= getUrlImageProduct($arrayData['pro_picture'], "medium");
	if($type == 'type'){
		$htmlReturn 	.= '<div class="product_item ' . $classAdd . '">
									<div class="product_img fl">
							         <a href="' . $linkProduct . '" title="' . htmlspecialbo($arrayData['pro_short_name']) . '">
							            <img src="' . $imageProduct . '" alt="' . htmlspecialbo($arrayData['pro_short_name']) . '">
							         </a>
							      </div>
							      <div class="product_detail fl">
								      <div class="product_name">
								         <a href="' . $linkProduct . '" title="' . htmlspecialbo($arrayData['pro_short_name']) . '">' . $arrayData['pro_short_name'] . '</a>
								      </div>
										<div class="product_attribute">' . $html_attribute . '</div>
									</div>
								</div>';
	}else{
		$htmlReturn 	.= '<div class="product_item ' . $classAdd . '">
						      <div class="product_name">
						         <a href="' . $linkProduct . '" title="' . htmlspecialbo($arrayData['pro_short_name']) . '">' . cut_string($arrayData['pro_short_name'], 30) . '</a>
						      </div>
						      <div class="product_img">
						         <a href="' . $linkProduct . '" title="' . htmlspecialbo($arrayData['pro_short_name']) . '">
						            <img src="' . $imageProduct . '" alt="' . htmlspecialbo($arrayData['pro_short_name']) . '">
						         </a>
						      </div>
								<div class="product_attribute">' . $html_attribute . '</div>
							</div>';
	}

	return $htmlReturn;
}

function showListProductMobile($arrayData = array(), $classAdd = "col-xs-12 col-sm-4 col-md-4"){

	global $arrayAttributeProduct;
	$htmlReturn 	= "";
	if(!isset($arrayData['pro_id'])) return $htmlReturn;

	$product_attribute 	= json_decode(base64_decode($arrayData['pro_attribute_data']), 1);
	$html_attribute 		= "";
	if(is_array($product_attribute)){
		$stt_attribute = 0;
		foreach ($product_attribute as $key => $value) {
			if($stt_attribute < 4 && $value != "" && isset($arrayAttributeProduct[$key]) && $arrayAttributeProduct[$key]['pra_show_home'] == 1){
				$stt_attribute++;
				$icon 	= "<span class='attribute_icon'></span>";
				if($arrayAttributeProduct[$key]['pra_icon_img'] != ""){
					$icon 	= "<span class='attribute_icon'><img src='" . PICTURE_PATH . "category/" . $arrayAttributeProduct[$key]['pra_icon_img'] . "'></span>";
				}
				$html_attribute 	.= '<div class="row attribute_item">
												<div class="col-xs-6 col-sm-6 col-md-6 attribute_name">' . $icon . $arrayAttributeProduct[$key]['pra_name'] . '<span class="space">:&nbsp;</span></div>
												<div class="col-xs-6 col-sm-6 col-md-6 attribute_value bold">' . $value . '</div>
												<div class="clear"></div>
											</div>';
			}
		}
	}

	$linkProduct 	= createlink("product", array("iData" => $arrayData['pro_id'], "nTitle" => $arrayData['pro_short_name']));
	$imageProduct 	= getUrlImageProduct($arrayData['pro_picture'], "medium");

	$htmlReturn		.= '<div class="' . $classAdd . '">
	                     <div class="item">
	                        <div class="post-thumb">
	                           <span class="mask">
	                              <a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">
	                                 <img class="lazy-load" alt="' . $arrayData['pro_short_name'] . '" src="' . $imageProduct . '" style="display: inline-block;" >
	                              </a>
	                           </span>
	                        </div>
	                        <div class="item-content">
	                           <div class="title-info">
	                              <h4 class="post-title"><a href="' . $linkProduct . '" title="' . $arrayData['pro_short_name'] . '">' . cut_string($arrayData['pro_short_name'], 30) . '</a></h4>
	                           </div>
	                           <div class="product_attribute">' . $html_attribute . '</div>
	                        </div>
	                     </div>
	                  </div>';

	return $htmlReturn;
}

/**
 * [getListNew description]
 * @param  integer $categoryID [description]
 * @param  integer $start      [description]
 * @param  integer $limit      [description]
 * @param  string  $sqlWhere   [description]
 * @param  string  $orderBy    [description]
 * @return [type]              [description]
 */
function getListNew($categoryID = 0, $start = 0, $limit = 0, $sqlWhere = "", $orderBy = ""){
	$categoryID	= intval($categoryID);
	$start		= intval($start);
	if($start <= 0) $start = 0;
	if($limit <= 0) $limit = 0;
	$limit 		= intval($limit);
	$sqlWhere 	= replaceMQ($sqlWhere);
	$orderBy		= replaceMQ($orderBy);

	$arrayReturn	= array();
	if($categoryID > 0){
		$InfoCat		= getInfoCategory($categoryID);
		$listCat		= isset($InfoCat['cat_all_child']) ? convert_list_to_list_id($InfoCat['cat_all_child']) : $categoryID;
		$sqlWhere	.= " AND new_category_id IN(" . $listCat . ")";
	}

	$sqlOrder		= " ORDER BY new_order ASC, new_id DESC";

	// Gán lại sql order nếu truyền trực tiếp
	if($orderBy != "") $sqlOrder	= $orderBy;
	if($orderBy == "none_order") $sqlOrder	= "";
	$sqlLimit 	= "";
	if($limit > 0) $sqlLimit	= " LIMIT " . $start . "," . $limit;

	$query	=	"SELECT *
					FROM news_multi
					STRAIGHT_JOIN categories_multi ON(cat_id = new_category_id)
					WHERE new_active = 1" . $sqlWhere . $sqlOrder . $sqlLimit;

	$db_query	= new db_query($query, "File: " . __FILE__ . ", Line: " . __LINE__);
	while($row	= mysqli_fetch_assoc($db_query->result)){
		$arrayReturn[$row["new_id"]] = $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}
function getCountNews($categoryID = 0)
{
    $categoryID = intval($categoryID);
    $sqlWhere = "";
    $total_record = 0;

    $arrayReturn = array();
    if ($categoryID > 0) {
        $InfoCat = getInfoCategory($categoryID);
        $listCat = isset($InfoCat['cat_all_child']) ? convert_list_to_list_id($InfoCat['cat_all_child']) : $categoryID;
        $sqlWhere .= " AND new_category_id IN(" . $listCat . ")";
    }

    $query = "SELECT COUNT(*) AS total_record
					FROM news_multi,categories_multi
					WHERE new_active = 1
					AND cat_id = new_category_id" . $sqlWhere;
    $db_query = new db_query($query, "File: " . __FILE__ . ", Line: " . __LINE__);
    while ($row = mysqli_fetch_assoc($db_query->result)) {
        $total_record = $row["total_record"];
    }
    $db_query->close();
    unset($db_query);

    return $total_record;
}
/**
 * [getInfoNew description]
 * @param  [type] $newId [description]
 * @return [type]        [description]
 */
function getInfoNew($newId){
	$newId			= intval($newId);
	$arrayReturn	= array();
	if($newId <= 0) return $arrayReturn;

	$query 		= "SELECT *
						FROM news_multi
						WHERE new_active= 1 AND new_id = " . intval($newId);
	$db_query	= new db_query($query);
	if($row = mysqli_fetch_assoc($db_query->result)){
		$arrayReturn	= $row;
	}
	$db_query->close();
	unset($db_query);

	return $arrayReturn;
}

function showListNew($arrayData = array(), $classAdd = ""){
   $htmlReturn 	= "";
   if(!isset($arrayData['new_id'])) return $htmlReturn;
   $linkBlog 	= createlink("news_detail", array("iData" => $arrayData['new_id'], "nTitle" => $arrayData['new_title']));
   // Lấy ảnh sản phẩm
   $url_image			= getImageNew($arrayData['new_picture'], "medium");

   $htmlReturn .= '<div class="news_detail_info ' . $classAdd . '">';
   $htmlReturn	.=	'<div class="thumb overlay">
                     <a  href="' . $linkBlog . '">
                        <img width="180" height="" src="' . $url_image . '" class="wp-post-image" alt="'. $arrayData['new_title'].'">
                     </a>
                  </div>';

   $htmlReturn .= '<div class="info">
   						<h2><a href="' . $linkBlog . '">'. $arrayData['new_title'] .'</a></h2>
   						<h3><a href="' . $linkBlog . '">'. cut_string($arrayData['new_teaser'], 160) .'</a></h3>
                  <div class="entry-meta"><span class="date"> '.date("d/m/Y", $arrayData['new_date']).' </span> <span class="views"> <span class="sep">/</span> '.$arrayData['new_hits'].' views </span>
                  </div>';
	$htmlReturn 	.= '<div class="view_news"><a href="' . $linkBlog . '">Xem thêm</a></div>';
   $htmlReturn 	.= '</div><div class="clear"></div></div>';

   return $htmlReturn;
}

function getImageNew($namePicture = "", $type = ""){
	$urlImage 	= "";
	if($namePicture == "") return $urlImage;

	$urlImage 	= PICTURE_PATH . 'new/';
	switch ($type) {
		default:
			$urlImage 	.= $namePicture;
			break;
	}

	return $urlImage;
}

function showListNewMobile($arrayData = array(), $classAdd = ""){
   $htmlReturn 	= "";
   if(!isset($arrayData['new_id'])) return $htmlReturn;
   $linkBlog 	= createlink("news_detail", array("iData" => $arrayData['new_id'], "nTitle" => $arrayData['new_title']));
   // Lấy ảnh sản phẩm
   $url_image			= getUrlImageBlog($arrayData['new_picture'], "medium");

   $htmlReturn .= '<div class="news_detail_info ' . $classAdd . '">';
   $htmlReturn	.=	'<div class="thumb col-xs-3 col-md-2">
                     <a  href="' . $linkBlog . '">
                        <img style="width: 100%;" src="' . $url_image . '" class="wp-post-image" alt="'. $arrayData['new_title'].'">
                     </a>
                  </div>';

   $htmlReturn .= '<div class="info col-xs-9 col-md-10">
   						<h2><a href="' . $linkBlog . '">'. $arrayData['new_title'] .'</a></h2>
   						<h3 class="hidden-xs"><a href="' . $linkBlog . '">'. $arrayData['new_teaser'] .'</a></h3>
                  <div class="entry-meta"><span class="date"> '.date("d/m/Y", $arrayData['new_date']).' </span> <span class="views"> <span class="sep">/</span> '.$arrayData['new_hits'].' views </span>
                  </div>';
   $htmlReturn 	.= '</div><div class="clearfix"></div></div>';

   return $htmlReturn;
}
function getUrlImageBlog($picture = "", $type = "medium"){
   $url 	= IMAGE_PATH_NEW;
   switch ($type) {

      default:
         $url 	.= "";
         break;
   }
   $url 	.= $picture;
   return $url;
}

function getListLanguage(){
	$arr_lang = array(1 => "EN");
	return $arr_lang;
}

function getComment($id = 0, $limit = 0, $sql_where = ""){
	$return = array();
	$sqlWhere = "";
	if($id > 0){
		$sqlWhere .= " AND com_id = " . $id;
	}

	$sqlWhere .=  $sql_where;

	$db_query = new db_query("SELECT * FROM comment WHERE com_active = 1 ". $sqlWhere . " ORDER BY com_id DESC ");
	while ($row = mysqli_fetch_assoc($db_query->result)) {
		$return[$row['com_id']] = $row;
	}
	return $return;
}

function getChildCity($iCit) {
	$iCit				= intval($iCit);
	$array_return  = array();

	$db_query		= new db_query("	SELECT cit_id, cit_name
												FROM city
												WHERE cit_parent_id = " . $iCit);
	while($row = mysqli_fetch_assoc($db_query->result)){
		$array_return[$row["cit_id"]]   = $row;
	}
	$db_query->close();
	unset($db_query);
	// Gán thêm cả iCit hiện tại vào
	$array_return[]= $iCit;

	return $array_return;
}

function getArrayCity(){
	$list_city = array();
	$db_query = new db_query("SELECT cit_id, cit_name FROM city WHERE cit_parent_id = 0 AND cit_active = 1 ORDER BY cit_order DESC");
	while ($row = mysqli_fetch_assoc($db_query->result)) {
		$list_city[$row['cit_id']] = $row['cit_name'];
	}
	return $list_city;
}

/** Check select tag
 *
 */
function checkTag($new_id, $tag_id)
{
    $check = 0;
    $query = "SELECT count(*) as count FROM news_tag WHERE nt_news_id = '" . $new_id . "'  AND nt_tag_id = " . $tag_id;
    $db_query = new db_query($query);
    if ($row = mysqli_fetch_assoc($db_query->result)) {
        if ($row['count'] > 0) {
            $check = 1;
        }
    }
    return $check;
}

/** Slect all tag
 *
 */
function getAllTagByNew($new_id)
{

    // Lấy toàn bộ tag
    $arrayTag = array();
    $arrayTagInfo = array();
    $sql_tag = "SELECT nt_tag_id FROM news_tag WHERE nt_news_id = " . $new_id;
    $db_tag = new db_query($sql_tag);
    while ($row_tag = mysqli_fetch_assoc($db_tag->result)) {
        $arrayTag[] = $row_tag['nt_tag_id'];
    }
    $listTag = convert_array_to_list($arrayTag);
    //Query lấy tag

    $db_select = new db_query("SELECT * FROM tags WHERE tag_id IN (" . $listTag . ")");
    while ($row = mysqli_fetch_assoc($db_select->result)) {
        $arrayTagInfo[] = $row;
    }
    unset($db_tag);
    unset($db_select);
    return $arrayTagInfo;
}

function getListTags($limit = 0, $sql_where = ""){
	if($limit <= 0) $limit = 15;
	$return = array();
	$db_query = new db_query("SELECT * FROM tags WHERE tag_active = 1 ". $sql_where . " LIMIT " . $limit);
	while ($row = mysqli_fetch_assoc($db_query->result)) {
		$return[$row['tag_id']] =  $row;
	}
	unset($db_query);
	return $return;
}

function templateDistrictMap($data) {
	$html = '<ul class="ulist-address">';
      foreach($data as $id => $district) {
      	if(isset($district['count_store']) && $district['count_store'] > 0)  {
				$html .= '<li class="fl"><label><input data-distid="'. $id .'" class="radio-district" type="radio" name="district"> '. $district['cit_name'] .' ('. $district['count_store'] .')</label></li>';
      	}
      }
      $html .= '<li class="clear"></li>';
	$html .= '</ul>';

	return $html;
}

/**
 * Get store avatar
 */
function get_store_avatar($store) {

	if(isset($store['sto_avatar']) && $store['sto_avatar'] != '') {
		return PICTURE_PATH  . 'avatar/' . $store['sto_avatar'];
	}
}

/**
 * Template cửa hàng trang map
 * @param  array $stores
 * @return html
 */
function templateStoreMap($stores) {
	global $pictures_path;
	$html = '';
	foreach($stores as $k => $store) {
		$html_image = '';

		$class_location_color	= 'map-icon-location-yellow';
		$custome_style				= ($k + 1) >= 10 ? 'text-indent:-4px' : '';
		$temp_html = array(
			'<div class="store-item">',
				'<div class="fl icon-store-location"><i id="icon-location-'. $store['sto_id'] .'" class="fl map-icons map-icon-location-right map-icon-location '. $class_location_color .'" style="'. $custome_style .'">'. ($k + 1) .'</i></div>',
				'<div class="info-store fl">',
					'<div class="name name-store" data-id="'. $store['sto_id'] .'" data-key="'. $k .'" data-latitude="'. $store['sto_latitude'] .'" data-longitude="'. $store['sto_longitude'] .'">'. $store['sto_name'] .'</div>',
					'<div class="address"><b>ĐC: </b>'. $store['sto_address'] .'</div>',
					'<div class="phone"><b>ĐT: </b>'. $store['sto_phone'] .'</div>',
					'<div class="clear"></div>',
				'</div>',
				'<div class="clear"></div>',
			'</div>'
		);
		$html .= implode($temp_html);
	}
	return $html;
}

// Danh sách các vị trí nhân viên
function list_recruiment_position(){
	$array = array(1=> "Kế toán",
						2=> "Pháp lý",
						3=> "Marketing",
						4=> "Kinh doanh",
						5=> "Thiết kế",
						6=> "Phát triển sản phẩm",
						7=> "Nhân sự");

	return $array;
}

/*
Hàm lấy tin tuyển dụng
 */
function get_list_recruitment($record_id = 0, $page_size = 10, $page = 1, $active = 1, $sql_where = '' ){

	$sql_where = ' AND rec_active =' . $active;
	if($page_size < 0)  $page_size = 1;
	if($record_id > 0){
		$sql_where .= ' AND rec_id = ' . $record_id;
	}

	$sql_select = "SELECT * FROM recruitment
						WHERE 1 ". $sql_where .
						" ORDER BY rec_expired_date DESC
						LIMIT ". ($page_size* ($page-1)) ." ," . $page_size ;
	// echo $sql_select;
	$db_query = new db_query($sql_select);
	$return = array();
	if($row = mysqli_fetch_assoc($db_query->result)){
		$return[$row['rec_id']] = $row;
	}
	return $return;
}

?>