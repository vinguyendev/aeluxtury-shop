<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 	= getValue("record_id");


//Khai báo biến khi thêm mới
$fs_title			= "Edit News";
$fs_action			= getURL();
$fs_errorMsg		= "";

$sev_create_time = time();
$sev_update_time = time();

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

	$myform->add("sev_title", "sev_title", 0, 0, " ", 1, "Bạn chưa nhập tiêu đề.", 0, "");
	$myform->add("sev_active", "sev_active", 1, 0, 0, 0, "", 0, "");
	$myform->add("sev_content", "sev_content", 0, 0, "", 0, "", 0, "");
	$myform->add("sev_hot", "sev_hot", 1, 0, 0, 0, "", 0, "");
	$myform->add("sev_parent_id", "sev_parent_id", 1, 0, 0, 0, "", 0, "");
	$myform->add("sev_update_time", "sev_update_time", 1, 1, 0, 0, "", 0, "");
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

	<tr>
		<td class="form_name">Dịch vụ chính:</td>
		<td>
			<select class="form-control" title="Danh mục NCC" id="sev_parent_id" name="sev_parent_id" style="width:250px" size="1">
				<?
				foreach ($arrSup as $key => $value) {
					$select = "";
					if($sev_parent_id == $key){
						$select = " selected";
					}
					echo '<option value="' . $key . '" ' . $select . '>' . $value . '</option>';
				}
				?>

			</select>
		</td>
	</tr>
	<?=$form->text("Tiêu đề", "sev_title", "sev_title", $sev_title, "Tiêu đề", 1, 250, "", 255, "", "", "")?>
	<?=$form->getFile("Ảnh minh họa", "sev_image", "sev_image", "Ảnh minh họa", 1, 40, "", "")?>
	<?=$form->checkbox("Hot", "sev_hot", "sev_hot", 1, $sev_hot, "Hot", 0, "", "")?>
	<?=$form->close_table();?>
	<?=$form->wysiwyg("Mô tả chi tiết", "sev_content", $sev_content, $wys_path, "99%", 450)?>
	<?=$form->create_table();?>
	<?=$form->checkbox("Kích hoạt", "sev_active", "sev_active", 1, $sev_active, "Kích hoạt", 0, "", "")?>
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