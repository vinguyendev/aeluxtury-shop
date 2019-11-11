<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect = base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id   = getValue("record_id");

//Get data edit
$record_id				= getValue("record_id");
$record_id				= getValue("record_id", "int", "POST", $record_id);
$db_edit					= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
if(mysqli_num_rows($db_edit->result) == 0){
	//Redirect if can not find data
	redirect($fs_error);
}
$edit						= mysqli_fetch_assoc($db_edit->result);
unset($db_edit);

//Khai báo biến khi thêm mới
$fs_title    = "Edit Album";
$fs_action   = getURL();
$fs_errorMsg = "";

$alb_create_time	= time();
$alb_active			= getValue("alb_active", "int", "POST", $edit["alb_active"]);
$alb_image			= getValue("alb_image", "str", "POST", $edit["alb_image"]);
$picture_data_json= json_decode(base64_url_decode($edit["alb_picture_json"]), true);
$alb_title			= getValue("alb_title", "str", "POST", $edit["alb_title"]);
$alb_order			= getValue("alb_order", "int", "POST", $edit["alb_order"]);
$alb_description	= getValue("alb_description", "str", "POST", $edit["alb_description"]);

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

///Get action variable for add new data
$action		 = getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	$myform      = new generate_form();
	$myform->add("alb_title","alb_title",0,0,"",1,translate("Vui lòng nhập tiêu đề!"),0,"");
	$myform->add("alb_image", "alb_image", 0, 0, $alb_image, 1, "Bạn chưa nhập ảnh", 0, "");
	$myform->add("alb_picture_json", "alb_picture_json", 0, 1, "", 0, "", 0, "");
	$myform->add("alb_order","alb_order",1,0,"",0,'',0,"");
	$myform->add("alb_active","alb_active",1,1,1,0,"",0,"");
	$myform->add("alb_create_time","alb_create_time",1,1,1,0,"",0,"");
	$myform->add("alb_description", "alb_description", 0, 0, "", 0, "", 0, "");
	$myform->addTable($fs_table);

	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	if($fs_errorMsg == ""){

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
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<p align="center" style="padding-left:10px;">
<?
$form = new form();
$form->create_form("edit", $fs_action, "post", "multipart/form-data",'onsubmit="addPictureData($(\'#picture_list\'), $(\'#picture_data\'))"');
$form->create_table();
?>
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