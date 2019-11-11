<?
include("inc_security.php");

// Có phải là edit không
// Khai báo biến
$prj_create_time = time();
$prj_update_time = time();
$prj_title       = "";
$prj_logo        = "";
$prj_description = "";
$prj_content     = "";
$prj_customer    = "";
$prj_location    = "";
$prj_linhvuc_id  = 0;
$prj_dichvu_id   = 0;
$prj_active      = 0;
$prj_hot         = 0;

$record_id                          = getValue("record_id", "int", "GET", 0);
//Khai báo biến khi thêm mới
$after_save_data                    = "add.php";
if($record_id > 0) $after_save_data = "listing.php";
$after_save_data                    = getValue("after_save_data", "str", "POST", $after_save_data);
$add                                = "add.php";
$listing                            = "listing.php";
$fs_title                           = "Thêm mới";
if($record_id > 0) $fs_title        = "Cập nhật";
$fs_action                          = getURL();
$fs_redirect                        = $after_save_data;
$fs_errorMsg                        = "";
$pro_color                          = '';

if($record_id > 0){
	// Lấy dữ liệu cần sửa đổi
	$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE prj_id = " . $record_id);
	if($row 		= mysqli_fetch_assoc($db_data->result)){
		foreach($row as $key=>$value){
			if($key!='lang_id' && $key!='admin_id') $$key = $value;
		}
	}else{
			exit("Record not found!!!");
	}
	unset($db_data);
}

$prj_linhvuc_id = getValue("prj_linhvuc_id", "int", "POST", $prj_linhvuc_id);
$prj_dichvu_id  = getValue("prj_dichvu_id", "int", "POST", $prj_dichvu_id);

// Gán lại thời gian cập nhật là thời gian mới nhất
$prj_update_time						= time();

$myform = new generate_form();
//Add table insert data

$myform->add("prj_linhvuc_id", "prj_linhvuc_id", 1, 1, 0, 0, "", 0, "");
$myform->add("prj_dichvu_id", "prj_dichvu_id", 1, 1, 0, 0, "", 0, "");

$myform->add("prj_title", "prj_title", 0, 0, $prj_title, 0, "Bạn chưa nhập tên Dự án.", 0, "");
$myform->add("prj_description", "prj_description", 0, 0, $prj_description, 0, "", 0, "");
$myform->add("prj_content", "prj_content", 0, 0, $prj_content, 0, "", 0, "");
$myform->add("prj_customer", "prj_customer", 0, 0, $prj_customer, 0, "", 0, "");
$myform->add("prj_location", "prj_location", 0, 0, "", 0, $prj_location, 0, "");
$myform->add("prj_create_time", "prj_create_time", 1, 1, 0, 0, "", 0, "");
$myform->add("prj_update_time", "prj_update_time", 1, 1, 0, 0, "", 0, "");
$myform->add("prj_active", "prj_active", 1, 0, 0, 0, "", 0, "");
$myform->add("prj_hot", "prj_hot", 1, 0, 0, 0, "", 0, "");

$myform->addTable($fs_table);

//Get action variable for add new data
$action                    = getValue("action", "str", "POST", "");

//Check $action for execute
if($action == "execute"){
	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	//Get $filename and upload
   	$filename	= "";
   	if($fs_errorMsg == ""){
   	   $upload_image 			= new upload_image();
   	   $upload_image->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
   	   $filename		= $upload_image->file_name;
   	   $fs_errorMsg	.= $upload_image->warning_error;
   	}
	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
			// resize
         	$upload_image->resize_image($fs_filepath, $filename, $width_small_image, $height_small_image, "small_", $fs_filepath . "small/", 100);
         	$upload_image->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "medium_", $fs_filepath . "medium/", 100);

		}//End if($filename != "")
		//Insert to database
		$myform->removeHTML(0);
		//Insert to database
		$myform->removeHTML(0);
		if($record_id > 0){

			$db_update = new db_execute($myform->generate_update_SQL("prj_id", $record_id));
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
		<!-- <li role="presentation" class=""><a href="#seo_info" role="tab" id="seo_info-tab" data-toggle="tab" aria-controls="seo_info" aria-expanded="false">Mô tả</a></li> -->
	</ul>
	<div class="tab-content" id="myTabContent" style="padding-top: 20px;">
		<div class="tab-pane fade active in" role="tabpanel" id="home" aria-labelledby="home-tab">
			<?
			$form->create_table();
			?>
			<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
			<?=$form->errorMsg($fs_errorMsg)?>
			<tr>
				<td class="form_name">* Lĩnh vực :</td>
				<td>
					<select class="form-control" title="Lĩnh vực" id="prj_linhvuc_id" name="prj_linhvuc_id" style="width:200px" >
						<?
						foreach ($arr_lv as $key => $value) {
							$select = "";
							if($prj_linhvuc_id == $key){
								$select = " selected";
							}
							echo '<option value="' . $key . '" ' . $select . '>' . $value . '</option>';
						}
						?>

					</select>
				</td>
			</tr>
			<tr>
				<td class="form_name">* Dịch vụ :</td>
				<td>
					<select class="form-control" title="Lĩnh vực" id="prj_dichvu_id" name="prj_dichvu_id" style="width:200px" >
						<?
						foreach ($arr_dv as $key => $value) {
							$select = "";
							if($prj_dichvu_id == $key){
								$select = " selected";
							}
							echo '<option value="' . $key . '" ' . $select . '>' . $value . '</option>';
						}
						?>

					</select>
				</td>
			</tr>
			<?=$form->text("Tên Dự án", "prj_title", "prj_title", $prj_title, "Tên Dự án", 1, 350, "", 255, "", "", "")?>
			<?=$form->getFile("Ảnh minh họa", "prj_logo", "prj_logo", "Ảnh minh họa", 1, 40, "", "")?>
			<?=$form->textarea("Mô tả", "prj_description", "prj_description", $prj_description, "Mô tả", 1, 350, 50, "", "", "")?>
			<?=$form->checkbox("Hot", "prj_hot", "prj_hot", 1, $prj_hot, "", 0, "", "")?>
			<?=$form->text("Khách hàng", "prj_customer", "prj_customer", $prj_customer, "Khách hàng", 1, 350, "", 255, "", "", "")?>
			<?=$form->text("Khu vực", "prj_location", "prj_location", $prj_location, "Khu vực", 1, 350, "", 255, "", "", "")?>
			<?=$form->close_table();?>
			<?=$form->create_table();?>
			<?=$form->wysiwyg("<b>Thông tin mô tả</b>", "prj_content", $prj_content, "../wysiwyg_editor/", "99%", 450)?>
			<?=$form->close_table();?>
			<?=$form->create_table();?>
			<?=$form->checkbox("Kích hoạt", "prj_active", "prj_active", 1, $prj_active, "", 0, "", "")?>
			<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
			<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
			<?=$form->hidden("action", "action", "execute", "");?>
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