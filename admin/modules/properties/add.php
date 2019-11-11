<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "add.php");
$add             = "add.php";
$listing         = "listing.php";
$fs_title        = "Add New Properties";
$fs_action       = getURL();
$fs_redirect     = $after_save_data;
$fs_errorMsg     = "";
$ppe_create_time = time();
$ppe_update_time = time();
$ppe_active      = getValue("ppe_active", "int", "POST", 1);

//Call Class generate_form();
$myform = new generate_form();
$myform->add("ppe_name","ppe_name",0,0,"",1,translate("Vui lòng nhập Tên Thuộc tính!"),0,"");
// $myform->add("ppe_type","ppe_type",1,0,"",0,'',0,"");
$myform->add("ppe_active","ppe_active",1,1,1,0,"",0,"");
$myform->add("ppe_create_time","ppe_create_time",1,1,1,0,"",0,"");
$myform->add("ppe_update_time","ppe_update_time",1,1,1,0,"",0,"");
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
	$ppe_active			= getValue("ppe_active", "int", "POST", 0);
	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	if($fs_errorMsg == ""){
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
	<?=$form->text("Tên Thuộc tính", "ppe_name", "ppe_name", $ppe_name, "Tên Thuộc tính", 1, 250, "", 255, "", "", "")?>

	<?=$form->checkbox("Kích hoạt", "ppe_active", "ppe_active", 1, $ppe_active, "Kích hoạt", 0, "", "")?>
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