<?

require_once("inc_security.php");

//check quyền them sua xoa

checkAddEdit("add");

//Khai bao bien

$fs_redirect		= "listing.php";

$fs_action			= getURL();

$cate_type			= getValue("cat_type","str","GET", "");

$cate_type			= getValue("cat_type","str","POST", $cate_type);

$sql					= "1";

//$menu 				= new menu();

//$listAll = $menu->getAllChild()

$cate_create_time 	= date("d-m-Y h:i:s", time());

$cate_update_time 	= $cate_create_time;

//Call Class generate_form();

$myform 				= new generate_form();

//Loại bỏ chuc nang thay the Tag Html

$myform->removeHTML(0);

$cate_name			= getValue("cate_name", "str", "POST", "", 1);

$cate_name_rewrite	= getValue("cate_name_rewrite", "str", "POST", "", 1);

if($cate_name_rewrite == "" && $cate_name != "") $cate_name_rewrite 	= removeTitle($cate_name);

$cate_description	= getValue("cate_description", "str", "POST", "");


if (get_magic_quotes_runtime() == 0){

    $cate_description	= stripslashes($cate_description);

}

$cate_description	= replaceFCK($cate_description, 1);

if($cate_name != "") {
    $db_ex 	= new db_execute_return();
    $querystr = "INSERT INTO categories (cate_name,cate_name_rewrite,cate_active,cate_description,cate_create_time,cate_update_time) VALUES ('$cate_name','$cate_name_rewrite',1,'$cate_description','$cate_create_time','$cate_update_time')";
    $last_id = $db_ex->db_execute($querystr);
    if($last_id>0) {
        die('Thêm danh mục thành công');
    }else {
        die('Thêm danh mục thất bại');
    }
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <?=$load_header?>

</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<?=template_top(translate_text("Thêm mới danh mục"))?>

<?

$form 	= new form();

$form->create_form("add", $fs_action, "post", "multipart/form-data");

$form->create_table();

?>

<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>

<?=$form->errorMsg($errorMsg)?>

<tr>
    <td align="right" nowrap class="textBold"><?=translate_text('Tên danh mục')?> *</td>
    <td>
        <input type="text" name="cate_name" id="cate_name" value="<?=$cate_name?>" maxlength="150" class="form-control">
    </td>
</tr>

<tr>
    <td></td>
    <td>
        <input type="hidden" name="cate_name_rewrite" id="cate_name_rewrite" value="<?=$cate_name_rewrite?>" size="50" maxlength="100" class="form-control">
    </td>
</tr>

<tr>
    <td class="bold" style="vertical-align: top;" nowrap="nowrap" align="right" width="15%"><?=translate_text("Miêu tả:")?></td>
    <td>
        <textarea name="cate_description" id="cate_description" value="<?=$cate_description?>" rows="5" cols="40"></textarea>
    </td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>
        <input type="submit" class="btn btn-sm btn-primary" value="<?=translate_text("Thêm mới")?>" style="cursor:hand;" onClick="validateForm();">&nbsp;

        <input type="reset" class="form" value="<?=translate_text("Làm mới")?>" style="cursor:hand;">

        <input type="hidden" name="active" value="1">

        <input type="hidden" name="action" value="insert">
    </td>
</tr>

<?=$form->close_table()?>

<?=$form->close_form()?>

<?=template_bottom() ?>

<? /*------------------------------------------------------------------------------------------------*/ ?>

</body>

</html>
