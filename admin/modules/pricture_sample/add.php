<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Thêm mới hình mẫu";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";
$pis_create_time	= time();

$pis_type	= 1;

$myform		= new generate_form();
$myform->add("pis_name", "pis_name", 0, 0, "", 1, "Bạn chưa nhập tên banner.", 0, "");
$myform->add("pis_type", "pis_type", 1, 0, "", 0, "", 0, "");
$myform->add("pis_create_time", "pis_create_time", 1, 1, 0, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, "", 0, "", 0, "");
$myform->addTable($fs_table);
//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
	//Check form data
	$fs_errorMsg .= $myform->checkdata();

	//Get $filename and upload
	$filename	= "";
	$filename1	= "";
	$filename2	= "";
	if($fs_errorMsg == ""){
		$upload_image 	= new upload_image();
		$upload_image->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);

		$filename		= $upload_image->file_name;
		$fs_errorMsg	.= $upload_image->warning_error;
		$fs_errorMsg	.= $upload_image->common_error;

		$upload_image 	= new upload_image();
		$upload_image->upload($fs_fieldupload1, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
		$filename1		= $upload_image->file_name;
		$fs_errorMsg	.= $upload_image->warning_error;
		$fs_errorMsg	.= $upload_image->common_error;

		$upload_image 	= new upload_image();
		$upload_image->upload($fs_fieldupload2, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
		$filename2		= $upload_image->file_name;
		$fs_errorMsg	.= $upload_image->warning_error;
		$fs_errorMsg	.= $upload_image->common_error;
	}

	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")
		if($filename1 != ""){
			$$fs_fieldupload1 = $filename1;
			$myform->add($fs_fieldupload1, $fs_fieldupload1, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")
		if($filename2 != ""){
			$$fs_fieldupload2 = $filename2;
			$myform->add($fs_fieldupload2, $fs_fieldupload2, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")

		//Insert to database
		$myform->removeHTML(0);
		$db_insert = new db_execute($myform->generate_insert_SQL());
		unset($db_insert);

		//Redirect after insert complate
		//redirect($fs_redirect);

	}//End if($fs_errorMsg == "")

}//End if($action == "insert")
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
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<p align="center" style="padding-left:10px;">
		<?
		$form = new form();
		$form->create_form("add", $fs_action, "post", "multipart/form-data");
		$form->create_table();
		?>
		<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
		<?=$form->errorMsg($fs_errorMsg)?>
		<?=$form->text("Tên ảnh", "pis_name", "pis_name", $pis_name, "Tên ảnh", 1, 250, "", 255, "", "", "")?>
		<?=$form->select("Loại hình", "pis_type", "pis_type", $arrType, $pis_type, "Loại hình", 0, 150, "", "", "", "")?>
		<?=$form->getFile("Ảnh chính", "pis_picture_main", "pis_picture_main", "Ảnh chính", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		<?=$form->getFile("Ảnh màu chính", "pis_picture_color_main", "pis_picture_color_main", "Ảnh màu chính", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		<?=$form->getFile("Ảnh màu nhấn", "pis_picture_color_highlight", "pis_picture_color_highlight", "Ảnh màu nhấn", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
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