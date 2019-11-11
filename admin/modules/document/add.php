<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "add.php");
$add             = "add.php";
$listing         = "listing.php";
$fs_title        = "Add New Tài liệu";
$fs_action       = getURL();
$fs_redirect     = $after_save_data;
$fs_errorMsg     = "";
$doc_create_time = time();
$doc_active      = getValue("doc_active", "int", "POST", 1);

//Call Class generate_form();
$myform = new generate_form();
$myform->add("doc_title","doc_title",0,0,"",1,translate("Vui lòng nhập tiêu đề!"),0,"");
$myform->add("doc_content","doc_content",0,0,"",0,'',0,"");
$myform->add("doc_active","doc_active",1,1,1,0,"",0,"");
$myform->add("doc_create_time","doc_create_time",1,1,1,0,"",0,"");
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
	$doc_active			= getValue("doc_active", "int", "POST", 0);
	//Check form data
	$fs_errorMsg .= $myform->checkdata();
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
		$db_insert = new db_execute($myform->generate_insert_SQL());
		unset($db_insert);
		//Redirect after insert complate
		redirect($fs_redirect);

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
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Tiêu đề", "doc_title", "doc_title", $doc_title, "Tiêu đề", 1, 250, "", 255, "", "", "")?>
	<?=$form->text("Link", "doc_content", "doc_content", $doc_content, "Link", 0, 250, "", 255, "", "", "")?>
	<?=$form->getFile("Ảnh minh họa", "doc_image", "doc_image", "Ảnh minh họa", 1, 40, "", "")?>
	<?=$form->checkbox("Kích hoạt", "doc_active", "doc_active", 1, $doc_active, "Kích hoạt", 0, "", "")?>
	<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", '' . $form->ec . '', "");?>
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