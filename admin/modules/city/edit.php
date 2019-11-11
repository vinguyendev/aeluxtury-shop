<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 	= getValue("record_id");

//Khai báo biến khi thêm mới
$fs_title			= "Edit City/District";
$fs_action			= getURL();
$fs_errorMsg		= "";
$myform = new generate_form();
$myform->add("cit_name", "cit_name", 0, 0, "", 1, "Bạn chưa nhập tên Tỉnh thành.", 0, "");
$myform->add("cit_order", "cit_order", 1, 0, 0, 0, "", 0, "");
$myform->add("cit_parent_id", "cit_parent_id", 1, 0, 0, 0, "", 0, "");
$myform->add("cit_map_longitude", "cit_map_longitude", 0, 0, "", 0, "", 0, "");
$myform->add("cit_map_latitude", "cit_map_latitude", 0, 0, "", 0, "", 0, "");
//Add table insert data
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){


	//Check form data
	$fs_errorMsg .= $myform->checkdata();

	if($fs_errorMsg == ""){

		//Insert to database
		$myform->removeHTML(0);
		$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
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

//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id, __FILE__, "USE_SLAVE");
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
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Tên tỉnh thành quận huyện", "cit_name", "cit_name", $cit_name, "Tên tỉnh thành quận huyện", 1, 250, "", 255, "", "", "")?>
	<?=$form->select("Cấp cha","cit_parent_id","cit_parent_id",$arrayParent,$cit_parent_id,"Cấp cha",0,150,0,0)?>
	<?=$form->text("Thứ tự", "cit_order", "cit_order", $cit_order, "Thứ tự", 0, 20, "", 255, "", "", "")?>
	<?=$form->text("Kinh độ", "cit_map_longitude", "cit_map_longitude", $cit_map_longitude, "Kinh độ", 0, 100, "", 255, "", "", "")?>
	<?=$form->text("Vĩ độ", "cit_map_latitude", "cit_map_latitude", $cit_map_latitude, "Vĩ độ", 0, 100, "", 255, "", "", "")?>
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