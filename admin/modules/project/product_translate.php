<?
include("inc_security.php");

//Call class menu
$listAll              = $arrCategory;
// Có phải là edit không
// Khai báo biến
$pro_date      = time();
$pro_update_at      = time();
$pro_picture_json     = "";
$pro_name            = "";
$pro_picture          = "";
$pro_category_id      = 0;
$pro_price            = 0;
$pro_picture_sale     = 0;
$pro_order            = 0;
$pro_hot              = 0;
$pro_meta_title       = "";
$pro_meta_keyword     = "";
$pro_meta_description = "";
$pro_description      = "";
$pro_content          = "";

$pro_present          = 0;
$pro_saleoff          = 0;
$pro_sale 				 = 0;
$pro_made_in          = "";
$pro_guarantee        = 0;
$pro_quantity         = 0;
$pro_size             = 0;
$pro_type             = 0;

$pro_color 			  = '';
$pro_translate_id   = 0;

$record_id        	= getValue("id", "int", "GET", 0);
$lang_id 				= getValue("lang", "int", "GET", 0);

//Khai báo biến khi thêm mới
$after_save_data 	= "listing.php";

$add						= "add.php";
$listing					= "listing.php";
$fs_title				= "Translate";
if($record_id > 0) $fs_title	= "Cập nhật";
$fs_action				= getURL();
$fs_redirect			= $after_save_data;
$fs_errorMsg			= "";

$fs_table_translate  = "products_translate";

if($record_id > 0 && $lang_id > 0){
	// Lấy dữ liệu cần sửa đổi
	// Lấy trong bảng dịch trc xem có không, nếu không thì lấy từ bàng products
	$db_data 	= new db_query("SELECT * FROM " . $fs_table_translate . " WHERE pro_id = " . $record_id . " AND lang_id = " . $lang_id);
	if($row 		= mysqli_fetch_assoc($db_data->result)){
		foreach($row as $key=>$value){
			if($key!='lang_id' && $key!='admin_id') $$key = $value;
		}
	}else{
		$db_pro 	= new db_query("SELECT * FROM " . $fs_table . " WHERE pro_id = " . $record_id);
		if($row 		= mysqli_fetch_assoc($db_pro->result)){
			foreach($row as $key=>$value){
				if($key!='lang_id' && $key!='admin_id') $$key = $value;
			}
		}else{
				exit("Record not found!!!");
		}
		unset($db_pro) ;
	}	
	unset($db_data);
}else{
	redirect($listing);
}

// Gán lại thời gian cập nhật là thời gian mới nhất
$pro_update_at						= time();


$picture_data_json 	= array();
if($pro_picture_json != "") $picture_data_json 	= json_decode(base64_decode($pro_picture_json), 1);
$picture_data_temp 	= array();
foreach ($picture_data_json as $key => $value) {
	if(isset($value['name']) && $value['name']) $picture_data_temp[] 	= $value['name'];
}
$picture_data_temp	= getValue("picture_data", "arr", "POST", $picture_data_temp);
$picture_data 			= array();
foreach ($picture_data_temp as $key => $value) {
	if($value != "") $picture_data[] 	= array("name" => $value);
}
$pro_picture_json 	= base64_encode(json_encode($picture_data));

$color     = getValue("color", "arr", "POST", convert_list_to_array($pro_color));
$pro_color = convert_array_to_list($color);

$myform = new generate_form();
//Add table insert data
$myform->add("pro_category_id", "pro_category_id", 1, 0, $pro_category_id, 0, "Bạn chưa chọn danh mục sản phẩm.", 0, "");
$myform->add("pro_name", "pro_name", 0, 0, $pro_name, 0, "Bạn chưa nhập tên sản phẩm.", 0, "");

$myform->add("pro_picture", "pro_picture", 0, 0, $pro_picture, 1, "Bạn chưa nhập ảnh", 0, "");
$myform->add("pro_picture_json", "pro_picture_json", 0, 1, "", 0, "", 0, "");
$myform->add("pro_price", "pro_price", 3, 0, 0, 0, "", 0, "");
$myform->add("pro_picture_sale", "pro_picture_sale", 3, 0, 0, 0, "", 0, "");

$myform->add("pro_meta_title", "pro_meta_title", 0, 0, $pro_meta_title, 0, "", 0, "");
$myform->add("pro_meta_keyword", "pro_meta_keyword", 0, 0, $pro_meta_keyword, 0, "", 0, "");
$myform->add("pro_meta_description", "pro_meta_description", 0, 0, $pro_meta_description, 0, "", 0, "");
$myform->add("pro_description", "pro_description", 0, 0, "", 0, $pro_description, 0, "");
$myform->add("pro_content", "pro_content", 0, 0, $pro_content, 0, "", 0, "");

$myform->add("admin_id", "admin_id", 1, 1, 0, 0, "", 0, "");
$myform->add("pro_date", "pro_date", 1, 1, 0, 0, "", 0, "");
$myform->add("pro_update_at", "pro_update_at", 1, 1, 0, 0, "", 0, "");
$myform->add("pro_active", "pro_active", 1, 0, 0, 0, "", 0, "");
$myform->add("pro_hot", "pro_hot", 1, 0, 0, 0, "", 0, ""); 
$myform->add("pro_order", "pro_order", 1, 0, 0, 0, "", 0, "");
 
$myform->add("lang_id", "lang_id", 1, 1, 0, 0, "", 0, "");
$myform->add("pro_id", "pro_id", 1, 1, 0, 0, "", 0, "");

$myform->addTable($fs_table_translate);

//Get action variable for add new data
$action                    = getValue("action", "str", "POST", "");
//Check $action for execute
if($action == "execute"){
	//Check form data
	$fs_errorMsg .= $myform->checkdata();

	if($fs_errorMsg == ""){
		//Insert to database
		$myform->removeHTML(0);
		//Insert to database
		$myform->removeHTML(0);
		if($pro_translate_id > 0){

			$db_update = new db_execute($myform->generate_update_SQL("pro_translate_id", $pro_translate_id));
			unset($db_update);

			redirect($fs_redirect);
		}else{
			$db_execute	= new db_execute_return();
			$last_id		= $db_execute->db_execute($myform->generate_insert_SQL());
			unset($db_execute);

			if($last_id > 0){

				redirect($fs_redirect);
			}else{
				$fs_errorMsg .= "&bull; Không insert được vào database. Bạn hãy kiểm tra lại câu lệnh INSERT INTO.<br />";
			}
		}

	}//End if($fs_errorMsg == "")

}//End if($action == "execute")
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
//add form for javacheck
$myform->addFormname("add");
$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
//$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;
?>
</head>

<style type="text/css">
ul.list_size_color{
padding: 0;
display: flex;
 flex-wrap: wrap;
 width: 450px;
}
ul.list_size_color li{
list-style: none;
width: 50px;
padding: 3px;
white-space: nowrap;
}
ul.list_size_color li input{
vertical-align: sub;
}
</style>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<div align="center" class="content">
<?
$form = new form();
$form->create_form("add", $fs_action, "post", "multipart/form-data");
?>
<div class="form_text" style="text-align: right; padding-right: 20px;"><input class="btn btn-primary btn-sm" type="submit" title="Cập nhật" id="submit" name="submit" value="Cập nhật"> <input class="btn btn-primary btn-sm" type="reset" title="Làm lại" id="reset" name="reset" value="Làm lại"></div>
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul class="nav nav-tabs" id="myTabs" role="tablist">
		<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Thông số</a></li>
		<li role="presentation" class=""><a href="#seo_info" role="tab" id="seo_info-tab" data-toggle="tab" aria-controls="seo_info" aria-expanded="false">Mô tả</a></li>
		<li role="presentation" class=""><a href="#properties" role="tab" id="properties-tab" data-toggle="tab" aria-controls="properties" aria-expanded="false">Thuộc tính</a></li>
	</ul>
	<div class="tab-content" id="myTabContent" style="padding-top: 20px;">
		<div class="tab-pane fade active in" role="tabpanel" id="home" aria-labelledby="home-tab">
			<?
			$form->create_table();
			?>
			<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
			<?=$form->errorMsg($fs_errorMsg)?>
			<?//=$form->select_db_multi("Danh mục", "pro_category_id", "pro_category_id", $listAll, "cat_id", "cat_name", $pro_category_id, "Danh mục sản phẩm", 1, 200, 1, 0, "", "")?>
			<?=$form->text("Tên sản phẩm", "pro_name", "pro_name", $pro_name, "Tên sản phẩm", 1, 350, "", 255, "", "", "")?>
			<input type="hidden" id="pro_picture" name="pro_picture" value="<?=$pro_picture?>" />
			<tr style="display: none">
				<td class="form_name">Ảnh sản phẩm:</td>
				<td>
					<?
					echo '<div class="form_upload_image">';
					include("inc_upload_multi.php");
					echo '</div>';
					?>
				</td>
			</tr>
			<?
			//$old_price_text			= ($pro_price > 0 ? '<span style="color: red; font-style: italic;" id="old_price_text">' . format_number($pro_price) . '</span>' : '<span style="color: red; font-style: italic;" id="old_price_text"></span>');
			?>
			<?//=$form->text("Giá", "pro_price", "pro_price", $pro_price, "Giá", 0, 150, "", 30, "", 'autocomplete="off" onkeyup="changePriceText(\'old_price_text\', this.value)"', ' VNĐ ' . $old_price_text)?>
			<?//=$form->text("Giá giảm", "pro_picture_sale", "pro_picture_sale", $pro_picture_sale, "Giá giảm", 0, 150, "", 30, "", 'autocomplete="off" onkeyup="changePriceText(\'old_price_text\', this.value)"', ' VNĐ ' )?>
			<?//=$form->text("Thứ tự", "pro_order", "pro_order", $pro_order, "Thứ tự", 0, 50, "", 255, "", "", "")?>
			<?//=$form->checkbox("Hot", "pro_hot", "pro_hot", 1, $pro_hot, "", 0, "", "")?>
			<?//=$form->checkbox("Giảm giá", "pro_sale", "pro_sale", 1, $pro_sale, "", 0, "", "")?>
			<?//=$form->checkbox("Kích hoạt", "pro_active", "pro_active", 1, $pro_active, "", 0, "", "")?>
			<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
			<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
			<?=$form->hidden("action", "action", "execute", "");?>
			<?=$form->hidden("pro_active", "pro_active", $pro_active, 0);?>
			<?
			$form->close_table();
			?>
		</div>
		<div class="tab-pane fade" role="tabpanel" id="seo_info" aria-labelledby="seo_info-tab">
			<?
			$form->create_table();
			?>
			<?=$form->text("Meta Title", "pro_meta_title", "pro_meta_title", $pro_meta_title, "Meta Title", 1, 350, "", 255, "", "", "")?>
			<?=$form->textarea("Meta Keyword", "pro_meta_keyword", "pro_meta_keyword", $pro_meta_keyword, "Meta keyword", 1, 350, 50, "", "", "")?>
			<?=$form->textarea("Meta Description", "pro_meta_description", "pro_meta_description", $pro_meta_description, "Meta Description", 1, 350, 50, "", "", "")?>
			<?=$form->close_table();?>
			<?=$form->create_table();?>
			<?=$form->wysiwyg("<b>Thông tin mô tả</b>", "pro_description", $pro_description, "../wysiwyg_editor/", "99%", 450)?>
			<?=$form->wysiwyg("<b>Mô tả chi tiết</b>", "pro_content", $pro_content, "../wysiwyg_editor/", "99%", 450)?>
			<?
			$form->close_table();
			?>
		</div>
		<div class="tab-pane fade" role="tabpanel" id="properties" aria-labelledby="properties-tab">
			<?
			$form->create_table(); 
			?> 
			<?
			$form->close_table();
			?>
		</div>

	</div>
</div>
<?
$form->close_form();
unset($form);
?>
</div>
</body>
</html>