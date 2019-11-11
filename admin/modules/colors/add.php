<?
include("inc_security.php");

//Khai báo biến
$after_save_data			= getValue("after_save_data", "str", "POST", "add.php");
$add_new						= "add.php";
$listing						= "listing.php";
$fs_title					= "Add Colors";
$fs_action					= getURL();
$fs_redirect				= base64_decode(getValue("url", "str", "GET", base64_encode($after_save_data)));
$fs_errorMsg				= "";

$record_id	= getValue("record_id");
if($record_id > 0){
	$fs_title					= "Edit color";
	checkAddEdit("edit");
}else{
	checkAddEdit("add");
}

// Các biến sản phẩm
$col_title			= '';
$col_code			= '';
$col_hex				= '';
$col_red				= 0;
$col_green			= 0;
$col_blue			= 0;
$col_group_id		= 0;
$col_color_text	= '';
$col_json_info		= '';
$col_create_time	= time();

if($record_id > 0){
	//lay du lieu cua record can sua doi
	$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
	if($row 		= mysqli_fetch_assoc($db_data->result)){
		foreach($row as $key => $value){
			if($key!='lang_id' && $key!='admin_id') $$key = $value;
		}
	}else{
		exit("Cannot find data");
	}
	$db_data->close();
	unset($db_data);
}

// Biến check xem khi add xong thì sẽ redirec sang trang nào
$col_title			= getValue("col_title", "str", "POST", $col_title, 1);
$col_code			= getValue("col_code", "str", "POST", $col_code, 1);
$col_group_id		= getValue("col_group_id", "int", "POST", $col_group_id);
$col_hex				= getValue("col_hex", "str", "POST", $col_hex, 1);
$col_color_text	= getValue("col_color_text", "str", "POST", $col_color_text, 1);

if($col_hex != ''){
	list($col_red, $col_group_id, $col_blue) = sscanf($col_hex, "%02x%02x%02x");
}

$myform = new generate_form();
$myform->add("col_group_id", "col_group_id", 1, 1, 1, 1, "Bạn chưa chọn nhóm color", 0, "");
$myform->add("col_code", "col_code", 0, 1, "", 1, "Bạn chưa nhập mã color vipec", 0, "");
$myform->add("col_title", "col_title", 0, 1, "", 0, "", 0, "");
$myform->add("col_hex", "col_hex", 0, 1, "", 1, "Bạn chưa nhập mã màu (hex)", 0, "");
$myform->add("col_color_text", "col_color_text", 0, 1, "", 0, "", 0, "");
$myform->add("col_red", "col_red", 0, 1, "", 0, "", 0, "");
$myform->add("col_green", "col_green", 0, 1, "", 0, "", 0, "");
$myform->add("col_blue", "col_blue", 0, 1, "", 0, "", 0, "");
$myform->add("col_create_time", "col_create_time", 1, 1, 0, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, 0, 0, "", 0, "");
$myform->add("lang_id", "lang_id", 1, 1, "", 0, "", 0, "");

//Add table insert data
$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	//Check form data
	$fs_errorMsg .= $myform->checkdata($id_field, $record_id);

	//Get $filename and upload
	$filename	= "";
   //Get $filename and upload
	if($filename == ""){
		//$fs_errorMsg .= "&bull; Bạn chưa nhập ảnh sản phẩm. <br />";
	}

	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")

		//Insert to database
		$myform->removeHTML(0);
		if($record_id > 0){
			$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
			unset($db_ex);
			redirect($fs_redirect);
		}else{
			$db_insert			= new db_execute_return();
			$last_prodct_id	= $db_insert->db_execute($myform->generate_insert_SQL());
			//Nếu insert sản phẩm thành công thì tiếp tục insert vào các bảng liên quan
			if($last_prodct_id > 0){
				redirect($after_save_data . '?record_id=' . $last_prodct_id);
			}
		}
		unset($db_insert);

	}//End if($fs_errorMsg == "")
}//End if($action == "insert")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->addFormname("add");
$myform->strJavascript = $myform->strJavascript;
$myform->checkjavascript();
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
echo $form->create_form("add", $fs_action, "post", "multipart/form-data",'id="fileupload" onsubmit="validateForm(); return false;"');
echo $form->create_table();

?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
 <?=$form->errorMsg($fs_errorMsg)?>
<?=$form->select("Group Color", "col_group_id", "col_group_id", $arrayGroup, $col_group_id, "Group Color", 0, 180, "", "", "", "")?>
<?=$form->text("Mã color vipec", "col_code", "col_code", $col_code, "Mã color vipec", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Tên màu sắc", "col_title", "col_title", $col_title, "Tên màu sắc",0, 450, "", 70, "", "", "")?>
<?=$form->text("Mã màu hex", "col_hex", "col_hex", $col_hex, "Mã màu hex",0, 250, "", 70, "", "", "")?>
<?=$form->text("Mã màu hex của text", "col_color_text", "col_color_text", $col_color_text, "Mã màu hex của text",0, 250, "", 70, "", "", "")?>
<tr>
	<td class="form_name">Sau khi lưu dữ liệu</td>
	<td>
		<span><input type="radio" checked="checked" name="after_save_data" value="<?=$add_new?>" id="add_new" /><label for="add_new">Thêm mới</label></span>
		<span><input type="radio" name="after_save_data" value="<?=$listing?>" id="listing" /><label for="listing">Về danh sách</label></span>
	</td>
</tr>
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
<script type="text/javascript">
	function changePriceText(class_show, value){
		$("#" + class_show).html(addCommas(value));
	}
</script>
