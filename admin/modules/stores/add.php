<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Add New Stores";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";

$sto_date			= time();

$myform = new generate_form();
$myform->add("sto_name", "sto_name", 0, 0, "", 1, "Bạn chưa nhập tên đại lý.", 0, "");
$myform->add("sto_city", "sto_city", 1, 0, 0, 1, "Chọn city của kho", 0, "" );
$myform->add("sto_district", "sto_district", 1, 0, 0, 1, "Chọn quận huyện của đại lý", 0, "" );
$myform->add("sto_phone", "sto_phone", 0, 0, "", 0, "", 0, "");
$myform->add("sto_address", "sto_address", 0, 0, "", 1, "Nhập địa chỉ đại lý", 0, "");
$myform->add("sto_email", "sto_email", 2, 0, "", 0, "", 0, "");
$myform->add("sto_latitude", "sto_latitude", 3, 0, 0, 1, "Nhập vĩ độ", 0, "");
$myform->add("sto_longitude", "sto_longitude", 3, 0, 0, 1, "Nhập kinh độ", 0, "");
$myform->add("sto_date", "sto_date", 1, 1, 0, 0, "", 0, "");
$myform->add("sto_time_work", "sto_time_work", 0, 0, '', 0, "", 0, "");
$myform->add("sto_business_registration", "sto_business_registration", 0, 0, '', 0, "", 0, "");
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

      // Upload ảnh đại diện
      if($filename != ""){
         $$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
      }

		//Insert to database
		$myform->removeHTML(0);
		$db_insert = new db_execute_return();
      $record_id = $db_insert->db_execute($myform->generate_insert_SQL());
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
		<?=$form->text("Tên đại lý", "sto_name", "sto_name", $sto_name, "Tên đại lý", 1, 250, "", 255, "", "", "")?>
      <?=$form->getFile("Ảnh đại diện", 'sto_avatar', 'sto_avatar', 'Ảnh đại diện')?>
		<?=$form->text("Email", "sto_email", "sto_email", $sto_email, "Email", 0, 250, "", 255, "", "", "")?>
		<?=$form->text("Điện thoại", "sto_phone", "sto_phone", $sto_phone, "Điện thoại", 0, 250, "", 250, "", "", "")?>
		<?=$form->text("Số đăng ký kinh doanh", "sto_business_registration", "sto_business_registration", $sto_business_registration, "Số đăng ký kinh doanh", 0, 250, "", 250, "", "", "")?>
		<?=$form->text("Địa chỉ", "sto_address", "sto_address", $sto_address, "Địa chỉ", 1, 250, "", 250, "", "", "")?>
		<?=$form->textarea("Thời gian làm việc", "sto_time_work", "sto_time_work", $sto_time_work, 'Thời gian làm việc', 0, 500)?>
		<?=$form->select("Chọn thành phố", "sto_city", "sto_city", $array_city, $sto_city, "Chọn thành phố", 1, 140, "", "", "", "")?>
		<tr>
         <td class="form_name">Quận Huyện</td>
         <td>
            <select name="sto_district" id="sto_district" class="form-control" style="width: 140px;">
            </select>
         </td>
      </tr>
		<?=$form->text("Vĩ độ", "sto_latitude", "sto_latitude", $sto_latitude, "Vĩ độ", 1, 250, "", 250, "", "", "")?>
		<?=$form->text("Kinh độ", "sto_longitude", "sto_longitude", $sto_longitude, "Kinh độ", 1, 250, "", 250, "", "", "")?>
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

<script>
$(function() {
   $('#sto_city').change(function() {
      var $this = $(this);
      $.ajax({
         url : 'ajax_load_districts.php',
         dataType : 'json',
         type : 'GET',
         data : {
            city_id : $this.val()
         },
         success : function(data) {
            var districts = data.districts;
            $('#sto_district').empty();
            for(var i in districts) {
               var option = $('<option>');
               option.val(districts[i].id)
                     .text(districts[i].name);
               $('#sto_district').append(option);
            }
         }
      });
   });
});
</script>
</body>
</html>