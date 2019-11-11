<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Thêm mới tiện ích";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= ""; 

$com_active = 1;
$com_date = time();

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
$myform->add("com_name", "com_name", 0, 0, "", 1, "Bạn chưa nhập tên KH", 0, "");  
$myform->add("com_title", "com_title", 0, 0, "", 1, "Bạn chưa nhập tiêu đề", 0, "");  
$myform->add("com_address", "com_address", 0, 0, "", 1, "", 0, "");  
$myform->add("com_comment", "com_comment", 0, 0, "", 1, " ", 0, "");  
$myform->add("com_date", "com_date", 1, 1, "", 1, " ", 0, "");  
$myform->add("com_active", "com_active", 1, 1, "", 1, " ", 0, "");  

//Add table insert data
$myform->addTable($fs_table);

//Get action variable for add new data
$action	= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	//Check form data
	$fs_errorMsg .= $myform->checkdata();
 	//Get $filename and upload
	$filename	= "";
	if($fs_errorMsg == ""){
		$upload 			= new upload_image();
		$upload->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);		
		$filename		= $upload->file_name;
		$fs_errorMsg	.= $upload->warning_error;
	}

	if($fs_errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
			// resize
			//$upload->resize_image($fs_filepath, $filename, $width_small_image, $height_small_image, "small_", $fs_filepath . "small/");
			//$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");

		}//End if($filename != "")
	 	
	 	//Insert to database
		$myform->removeHTML(0);
		$db_insert		= new db_execute_return();
		$last_city_id	= $db_insert->db_execute($myform->generate_insert_SQL());
		unset($db_insert);

		if($last_city_id > 0){
			//Redirect after insert complate
			redirect($fs_redirect);
		}
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
	<?=$form->text("Tên khách hàng", "com_name", "com_name", $com_name, "Khách hàng", 1, 250, "", 255, "", "", "")?> 	
	<?=$form->text("Tiêu đề", "com_title", "com_title", $com_title, "Tiêu đề", 1, 250, "", 255, "", "", "")?> 	
	<?=$form->text("Địa chỉ", "com_address", "com_address", $com_address, "Địa chỉ", 1, 250, "", 255, "", "", "")?> 
	<?=$form->textarea("Nội dung", "com_comment", "com_comment", $com_comment, "Nội dung", 1, 550, "", 555, "", "", "")?> 	
	<?=$form->getFile("Ảnh đại diện", "com_picture", "com_picture", "ảnh đại diện", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
		
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

<script type="text/javascript">
	function change_utl_type() {
		var utl_type = $("#utl_type").val();

		if(utl_type == 2){
			$("#utl_parent_id").show();
		}else{
			$("#utl_parent_id").hide();
		}
	}
</script>
</body>
</html>
