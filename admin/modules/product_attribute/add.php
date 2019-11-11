<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("add");

$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title			= "Thêm mới thuộc tính sản phẩm";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$sql						=	"";
$pra_date            = time();
$pra_status          = 1;

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
$myform->add("pra_name","pra_name",0,0,"",0,"",0,"");
$myform->add("pra_parent_id","pra_parent_id",1,0,"",0,"",0,"");
$myform->add("pra_status","pra_status",1,1,"",0,"",0,"");
$myform->add("pra_order","pra_order",1,0,"",0,"",0,"");
$myform->add("pra_date","pra_date",1,1,0,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "execute"){
	//Check Error!
	$errorMsg .= $myform->checkdata();

	//Get $filename and upload
	$filename	= "";
	if($errorMsg == ""){
		$upload_image 			= new upload_image();
		$upload_image->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, $fs_insert_logo);
		$filename		= $upload_image->file_name;
		$errorMsg	.= $upload_image->warning_error;
	}

	if($errorMsg == ""){
		if($filename != ""){
			$$fs_fieldupload = $filename;
			$myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
		}//End if($filename != "")

		//Insert to database
		$myform->removeHTML(0);

		$db_ex 	= new db_execute_return();
		$last_id = $db_ex->db_execute($myform->generate_insert_SQL());
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
$myform->evaluate();
$myform->checkjavascript();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Thêm mới hỗ trợ"))?>
		<? /*---------Body------------*/ ?>
		<?
		$form 	= new form();
		?>
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" METHOD="POST" name="add_new" onSubmit="validateForm(); return false;" enctype="multipart/form-data">
		<table class="table table_border_none">
			<tr>
				<td></td>
				<td>Những trường có dấu * là bắt buộc phải nhập !</td>
			</tr>
         <tr>
            <td class="bold" nowrap="nowrap" align="right" width="12%"><?=translate_text("Tên thuộc tính")?>:</td>
            <td>
            <input type="text" name="pra_name" id="pra_name" class="form-control" size="40"  value="<?=$pra_name?>"></td>
         </tr>
         <tr>
            <td class="bold" nowrap="nowrap" align="right" width="12%"><?=translate_text("Thuộc tính cha")?>:</td>
            <td>
            	<select class="form-control" name="pra_parent_id" id="pra_parent_id">
            		<option>--Thuộc tính cha--</option>
	            	<?
	            	foreach ($arrayNameAttribute as $key => $value) {
	            		$space 	= "";
	            		for ($i = 0; $i < $value['level']; $i++) {
	            			$space 	.= "--";
	            		}
	            		?>
	            		<option value="<?=$value['pra_id']?>"><?=$space . $value['pra_name']?></option>
	            		<?
	            	}
	            	?>
	            </select>
            </td>
         </tr>
			<?=$form->getFile("Ảnh minh họa", "pra_icon_img", "pra_icon_img", "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
         <tr>
            <td class="bold" nowrap="nowrap" align="right" width="10%"><?=translate_text("Thứ tự")?>:</td>
            <td>
            <input type="text" name="pra_order" id="pra_order" class="form-control" size="2"  value="<?=$pra_order?>"></td>
         </tr>
         <?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
			<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", $form->ec, "");?>
			<?=$form->hidden("action", "action", "execute", "");?>
		</table>
		</form>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>