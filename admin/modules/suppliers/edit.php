<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 	= getValue("record_id");


//Call class menu
$class_menu			= new menu();
$listAll				= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "cat_type='news' AND lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($class_menu);

//Khai báo biến khi thêm mới
$fs_title			= "Edit nhà cung cấp";
$fs_action			= getURL();
$fs_errorMsg		= "";

$sup_slider_json   = "";
$sup_edit_time   = time();

$picture_data_json = array();
if($sup_slider_json != "") $picture_data_json 	= json_decode(base64_decode($sup_slider_json), 1);
$picture_data_temp 	= array();
foreach ($picture_data_json as $key => $value) {
	if(isset($value['name']) && $value['name']) $picture_data_temp[] 	= $value['name'];
}
$picture_data_temp	= getValue("picture_data", "arr", "POST", $picture_data_temp);

$picture_data 			= array();
foreach ($picture_data_temp as $key => $value) {
	if($value != "") $picture_data[] 	= array("name" => $value);
}
$sup_slider_json 	= base64_encode(json_encode($picture_data));

/*
Call class form:
1). Ten truong
2). Ten form
3). Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double, 4 : kieu hash password
4). Noi luu giu data  0 : post, 1 : variable
5). Gia tri mac dinh, neu require thi phai lon hon hoac bang default
6). Du lieu nay co can thiet hay khong
7). Loi dua ra man hinh
8). Chi co duy nhat trong database
9). Loi dua ra man hinh neu co duplicate
*/

$myform = new generate_form();
$myform->add("sup_name", "sup_name", 0, 0, " ", 1, "Bạn chưa nhập tên nhãn hiệu.", 0, "Nhãn hiệu này đã tồn tại");
$myform->add("sup_slider_json", "sup_slider_json", 0, 1, " ", 0, "", 0, "");
$myform->add("sup_description", "sup_description", 0, 0, " ", 0, "", 0, "");
$myform->add("sup_fanpage", "sup_fanpage", 0, 0, " ", 0, "", 0, "");
$myform->add("sup_meta_description", "sup_meta_description", 0, 0, " ", 0, "", 0, "");
$myform->add("sup_contact", "sup_contact", 0, 0, " ", 0, "", 0, "");
$myform->add("sup_active", "sup_active", 1, 0, 0, 0, "", 0, "");
$myform->add("sup_edit_time", "sup_edit_time", 1, 1, 0, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, "", 0, "", 0, "");

//Add table insert data
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){


	//Check form data
	$fs_errorMsg .= $myform->checkdata();

   //Get $filename and upload
   $filename	= "";
   	$filename2	= "";
   if($fs_errorMsg == ""){
      $upload_image 			= new upload_image();
      $upload_image->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
      $filename		= $upload_image->file_name;
      $fs_errorMsg	.= $upload_image->warning_error;

      $upload_image = new upload_image();
		$upload_image->upload($fs_fieldupload2, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
		$filename2     = $upload_image->file_name;
		$fs_errorMsg     .= $upload_image->warning_error;
   }

	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");

	
		}//End if($filename != "")

		if($filename2 != ""){
			$$fs_fieldupload = $filename2;
			$myform->add($fs_fieldupload2, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		
		}//End if($filename != "")

		//Insert to database
		$myform->removeHTML(0);
		$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
		//Redirect to:
		redirect($fs_redirect);

	}//End if($fs_errorMsg == "")

}//End if($action == "execute")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
//add form for javacheck
$myform->addFormname("add");

$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;

//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
if($row 		= mysqli_fetch_assoc($db_data->result)){
	foreach($row as $key=>$value){
		if($key!='lang_id' && $key!='admin_id') $$key = $value;
	}
	if($sup_slider_json != ""){
		$picture_data =  json_decode(base64_decode($sup_slider_json),1);
	}
	
}else{
		exit();
}

?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Tên nhãn hàng", "sup_name", "sup_name", $sup_name, "Tên nhãn hàng", 1, 250, "", 255, "", "", "")?>
	<?=$form->getFile("Logo", "sup_logo", "sup_logo", "Logo", 1, 40, "", "")?>
	<tr>
		<td class="form_name"></td>
		<td>
			<img src="/data/supplier/<?=$sup_logo?>" style="width: 150px;">
		</td>
	</tr>
	<?=$form->getFile("Ảnh giới thiệu", "sup_image_info", "sup_image_info", "Ảnh giới thiệu", 1, 40, "", "")?>
	<tr>
		<td class="form_name"></td>
		<td>
			<img src="/data/supplier/<?=$sup_image_info?>" style="width: 150px;">
		</td>
	</tr>
	<tr>
		<td class="form_name">Ảnh slider:</td>
		<td>
			<?
			echo '<div class="form_upload_image">';
			include("inc_upload_multi.php");
			echo '</div>';
			?>
		</td>
	</tr>
	<?=$form->textarea("Meta description", "sup_meta_description", "sup_meta_description", $sup_meta_description, "Meta description", 1, 350, 50, "", "", "")?>
	<?=$form->textarea("Fanpage", "sup_fanpage", "sup_fanpage", $sup_fanpage, "Fanpage", 1, 350, 50, "", "", "")?>
	<?=$form->close_table();?>
	<?=$form->wysiwyg("Mô tả chi tiết", "sup_description", $sup_description, $wys_path, "99%", 250)?>

	<?=$form->wysiwyg("Liên hệ", "sup_contact", $sup_contact, $wys_path, "99%", 250)?>
	<?=$form->create_table();?>
	<?=$form->checkbox("Kích hoạt", "sup_active", "sup_active", 1, $sup_active, "Kích hoạt", 0, "", "")?>
	
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
	<?
	$form->close_table();
	$form->close_form();
	unset($form);
	?>
	</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>