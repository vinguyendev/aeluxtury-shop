<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect = base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id   = getValue("record_id");

//Khai báo biến khi thêm mới
$fs_title    = "Edit Tài liệu";
$fs_action   = getURL();
$fs_errorMsg = "";

$doc_create_time = time();
$doc_active      = getValue("doc_active", "int", "POST", 1);

$myform = new generate_form();
$myform->add("doc_title","doc_title",0,0,"",1,translate("Vui lòng nhập tiêu đề!"),0,"");
$myform->add("doc_content","doc_content",0,0,"",0,'',0,"");
$myform->add("doc_active","doc_active",1,1,1,0,"",0,"");
$myform->add("doc_create_time","doc_create_time",1,1,1,0,"",0,"");
$myform->addTable($fs_table);

///Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
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
		$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
		unset($db_update);

		//Redirect after insert complate
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
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->addFormname("edit");
$myform->checkjavascript();
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

<p align="center" style="padding-left:10px;">
<?
$form = new form();
$form->create_form("edit", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
$form->create_table();
?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->text("Tiêu đề", "doc_title", "doc_title", $doc_title, "Tiêu đề", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Link", "doc_content", "doc_content", $doc_content, "Link", 0, 250, "", 255, "", "", "")?>
<?=$form->getFile("Ảnh minh họa", "doc_image", "doc_image", "Ảnh minh họa", 1, 40, "", "")?>
<?=$form->checkbox("Kích hoạt", "doc_active", "doc_active", 1, $doc_active, "Kích hoạt", 0, "", "")?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", '' . $form->ec . '', "");?>
<?=$form->hidden("action", "action", "execute", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
</p>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>