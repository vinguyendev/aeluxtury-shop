<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Edit Stores";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 		= getValue("record_id", "int", "GET", 0);

$sto_date			= time();
$sto_key				= getValue("sto_key", "int", "POST", 0);

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
      if($filename != '') {
        	$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
      }

		//Update to database
		$myform->removeHTML(0);
		$db_update	= new db_execute($myform->generate_update_SQL($id_field, $record_id));
		unset($db_update);

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

//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
if($row 		= mysqli_fetch_assoc($db_data->result)){
	foreach($row as $key=>$value){
		if($key!='lang_id' && $key!='admin_id') $$key = $value;
	}
}else{
		exit();
}


// Tìm quận huyện theo thành phố
$temp_districts	= getChildCity($row['sto_city']);
$districts			= array();
foreach($temp_districts as $key => $value) {
	$districts[$key]['id'] = $value['cit_id'];
	$districts[$key]['name'] = $value['cit_name'];
}

?>

<style>
	.item-img-container {
		float:left;
		position: relative;
		margin-right: 5px;
		display: inline;
	}
	.img-delete {
		position: absolute;
		right: 0px;
		top: -20px;
		font-weight: bold;
		color: #4E4E4E;
		cursor: pointer;
		font-size: 12px;
		background: #EDEDED;
		padding: 0px 5px;
	}
</style>
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
		<?
		if($row['sto_avatar'] != ""){
			?>
			<tr>
				<td class="form_name">Ảnh đại diện</td>
				<td><img src="<?=$fs_filepath . $row['sto_avatar']?>" width="50px" height="50px" /></td>
			</tr>
			<?
		}
		?>

      <?=$form->getFile('Ảnh đại diện', 'sto_avatar', 'sto_avatar', 'Ảnh đại diện')?>
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
               <?php foreach($districts as $id => $district) : ?>
               <option value="<?php echo $id ?>" <?php if($id == $row['sto_district']) echo 'selected="selected"' ?>><?php echo $district['name'] ?></option>
               <?php endforeach; ?>
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


   $('.img-delete').click(function() {
   	var $this = $(this);
   	var id = $this.data('id');
   	var ans = confirm('Bạn có chắc chắn muốn xóa ảnh này');
		if(ans) {
			$.ajax({
				url : 'ajax_remove_image_store.php',
				dataType : 'json',
				type : 'POST',
				data : {
					id : id
				},
				success : function(data) {
					alert(data.message);
					if(data.code === 1) {
						$this.parent('li').remove();
					}
				}
			})
		}
   })
});
</script>
</body>
</html>