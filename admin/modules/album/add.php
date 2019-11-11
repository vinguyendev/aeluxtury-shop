<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Add New Album";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";
$alb_create_time	= time();
$alb_active			= getValue("alb_active", "int", "POST", 1);
$alb_picture_json	= "";
$alb_image			= "";

$picture_data_json 	= array();
if($alb_picture_json != "") $picture_data_json 	= json_decode(base64_decode($alb_picture_json), 1);
$picture_data_temp 	= array();
foreach ($picture_data_json as $key => $value) {
	if(isset($value['name']) && $value['name']) $picture_data_temp[] 	= $value['name'];
}
$picture_data_temp	= getValue("picture_data", "arr", "POST", $picture_data_temp);
$picture_data 			= array();
foreach ($picture_data_temp as $key => $value) {
	if($value != "") $picture_data[] 	= array("name" => $value);
}
$alb_picture_json 	= base64_encode(json_encode($picture_data));

//Call Class generate_form();
$myform = new generate_form();
$myform->add("alb_title","alb_title",0,0,"",1,translate("Vui lòng nhập tiêu đề!"),0,"");
$myform->add("alb_order","alb_order",1,0,"",0,'',0,"");
$myform->add("alb_image", "alb_image", 0, 0, $alb_image, 1, "Bạn chưa nhập ảnh", 0, "");
$myform->add("alb_picture_json", "alb_picture_json", 0, 1, "", 0, "", 0, "");
$myform->add("alb_active","alb_active",1,1,1,0,"",0,"");
$myform->add("alb_create_time","alb_create_time",1,1,1,0,"",0,"");
$myform->add("alb_description", "alb_description", 0, 0, "", 0, "", 0, "");
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
	$alb_active			= getValue("alb_active", "int", "POST", 0);
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
	<?=$form->text("Tiêu đề", "alb_title", "alb_title", $alb_title, "Tiêu đề", 1, 250, "", 255, "", "", "")?>
	<input type="hidden" id="alb_image" name="alb_image" value="<?=$alb_image?>" />
	<tr>
		<td class="form_name">Ảnh album:</td>
		<td>
			<?
			echo '<div class="form_upload_image">';
			include("inc_upload_multi.php");
			echo '</div>';
			?>
		</td>
	</tr>
	<?=$form->text("Thứ tự", "alb_order", "alb_order", $alb_order, "Thứ tự", 0, 100, "", 255, "", "", "")?>
	<?=$form->checkbox("Kích hoạt", "alb_active", "alb_active", 1, $alb_active, "Kích hoạt", 0, "", "")?>
	<?=$form->close_table();?>
	<?=$form->wysiwyg("Mô tả chi tiết", "alb_description", $alb_description, $wys_path, "99%", 450)?>
	<?=$form->create_table();?>
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