<?
	include("inc_security.php");

	//Khai báo biến khi thêm mới
	$fs_title				= "Cấu hình about";
	$fs_action				= getURL();
	$fs_redirect			= getURL();
	$fs_errorMsg			= "";

	//Get data edit
	$record_id				= $lang_id;
	$db_edit				= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
	if(mysqli_num_rows($db_edit->result) == 0){
		//Redirect if can not find data
		redirect($fs_error);
	}
	$edit						= mysqli_fetch_assoc($db_edit->result);
	unset($db_edit);

	$myform = new generate_form();
	$myform->add("ab_text1", "ab_text1", 0, 0, $edit["ab_text1"], 0, "", 0, "");
	$myform->add("ab_text2", "ab_text2", 0, 0, $edit["ab_text2"], 0, "", 0, "");
	$myform->add("ab_title_home1", "ab_title_home1", 0, 0, $edit["ab_title_home1"], 0, "", 0, "");
	$myform->add("ab_title_home2", "ab_title_home2", 0, 0, $edit["ab_title_home2"], 0, "", 0, "");
	

	$myform->addTable($fs_table);
	$action					= getValue("action", "str", "POST", "");
	//Check $action for insert new data
	if($action == "execute"){
		//Check form data
		$fs_errorMsg .= $myform->checkdata();

      //Get $filename and upload
   	$filename	= "";
   	if($fs_errorMsg == ""){
   		$upload_image 			= new upload_image();
			$upload_image->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
   		$filename		= $upload_image->file_name;
   		$fs_errorMsg  .= $upload_image->warning_error;
   	}

      if($filename != "") {
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")

		//Get $filename and upload bg detail
   
		if($fs_errorMsg == "") {

			//Insert to database
			$myform->removeHTML(0);

			$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
			unset($db_update);

			redirect($fs_redirect);

		}//End if($fs_errorMsg == "")

	}//End if($action ==1 "insert")

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("edit", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Tiêu đề 1 (home)", "ab_title_home1", "ab_title_home1", $ab_title_home1, "Tiêu đề 1 (home)", 1, 350, "", 255, "", "", "")?>
	<?=$form->text("Tiêu đề 2 (home)", "ab_title_home2", "ab_title_home2", $ab_title_home2, "Tiêu đề 2 (home)", 1, 350, "", 255, "", "", "")?>
	<?= $form->getFile("Ảnh ", "ab_img1", "ab_img1", "Ảnh ", 1, 32, "", "") ?>
    <tr id="ab_img1">
        <td class="form_name"></td>
        <td class="form_text">
            <? if ($edit["ab_img1"] != "") { ?>
                <img width="185px" src="../../../data/background/<?= $edit["ab_img1"] ?>"/>
                <a href="javascript:;" onclick="delete_background(1)">Xóa</a>
            <? } ?>
        </td>
    </tr>
    <?=$form->textarea("Mô tả", "ab_text1", "ab_text1", $ab_text1, "Mô tả", 0, 350, 150, "", "", "")?>
	<?=$form->close_table();?>
	<?=$form->wysiwyg("Nội dung ", "ab_text2", $ab_text2, $wys_path, "99%", 250)?>
	<?=$form->create_table();?>
    
    
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
    <?=$form->hidden("action", "action", "execute", "");?>
	<?
	$form->close_form();
	unset($form);
	?>
	</p>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script type="text/javascript">
	function delete_background(id){
		$.post("delete_background.php",{
			id:id
		}, function(json){
			if(json.code == 1){
				alert("Xóa thành công");
				if (id == 1) {
					$("#con_background_img").html("");
				}else if(id == 2){
					$("#con_background_homepage").html("");
				};
			}else{
				alert("Xảy ra lỗi khi xóa");
			}
		}, 'json')
	}
</script>