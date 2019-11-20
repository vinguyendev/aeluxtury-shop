<h1>Welcome Goods</h1>

<?

include("inc_security.php");

$db_cate = new db_query("SELECT cate_id, cate_name FROM categories");

$arrCategory = array();

while($row = mysqli_fetch_assoc($db_cate->result))  $arrCategory[$row["cate_id"]] = $row["cate_name"];


//// Khai báo biến

$go_create_time = date("d-m-Y h:i:s", time());
$go_update_time = date("d-m-Y h:i:s", time());
$go_picture = "";
$go_name = getValue("go_name","str","POST","",1);
$go_category_id = getValue("go_category_id","int","POST",0,1);
$go_description = getValue("go_description","str","POST","",1);
$go_active = 1;
$go_price = getValue("go_price","flo","POST",0,1);
$go_code = getValue("go_code","str","POST","",1);
$go_size = getValue("go_size","str","POST","",1);

if (get_magic_quotes_runtime() == 0){
    $go_description	= stripslashes($go_description);
}

$go_description	= replaceFCK($go_description, 1);

if(isset($_POST['upload'])) {
    // Get image name
    $go_picture = $_FILES['go_picture']['name'];

    // image file directory
    $target = "images/".basename($go_picture);

    if (move_uploaded_file($_FILES['go_picture']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    $db_ex 	= new db_execute_return();

    $queryStr = "INSERT INTO goods (go_code,go_name,go_description,go_size,go_picture,go_price,go_active,go_category_id,go_create_time,go_update_time) VALUES ('$go_code','$go_name','$go_description','$go_size','$go_picture','$go_price','$go_active','$go_category_id','$go_create_time','$go_update_time')";

    $last_id = $db_ex->db_execute($queryStr);
    if($last_id>0) {
        die('Thêm sản phẩm thành công');
    }else {
        die('Thêm sản phẩm thất bại');
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
<?=template_top(translate_text("Thêm sản phẩm mới"))?>

<?

$form 	= new form();

$form->create_form("add", $fs_action, "post", "multipart/form-data");

$form->create_table();

?>

<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>

<?=$form->errorMsg($errorMsg)?>

    <tr>
        <td align="right" nowrap class="textBold"><?=translate_text('Dòng sản phẩm')?> *</td>
        <td>
            <select class="form-control" name="go_category_id" id="go_category_id">
                <option value="">Chọn dòng sản phẩm</option>
                <? foreach ($arrCategory as $key => $value) { ?>
                    <option value="<?= $key ?>"><?=$value?></option>
                <? } ?>
            </select>
        </td>
    </tr>

    <tr>
        <td align="right" nowrap class="textBold"><?=translate_text('Mã code')?> *</td>
        <td>
            <input type="text" name="go_code" id="go_code" value="<?=$go_code?>" maxlength="150" class="form-control">
        </td>
    </tr>

    <tr>
        <td align="right" nowrap class="textBold"><?=translate_text('Tên sản phẩm')?> *</td>
        <td>
            <input type="text" name="go_name" id="go_name" value="<?=$go_name?>" maxlength="150" class="form-control">
        </td>
    </tr>

    <tr>
        <td align="right" nowrap class="textBold"><?=translate_text('Kích thước')?> *</td>
        <td>
            <input type="text" name="go_size" id="go_size" value="<?=$go_size?>" maxlength="150" class="form-control">
        </td>
    </tr>

    <tr>
        <td align="right" nowrap class="textBold"><?=translate_text('Giá')?> *</td>
        <td>
            <input type="text" name="go_price" id="go_price" maxlength="150" class="form-control">
        </td>
    </tr>

    <tr>
        <td class="bold" style="vertical-align: top;" nowrap="nowrap" align="right" width="15%"><?=translate_text("Mô tả:")?></td>
        <td>
            <textarea name="go_description" id="go_description" value="<?=$go_description?>" rows="5" cols="40"></textarea>
        </td>
    </tr>

    <tr>
        <td class="bold" style="vertical-align: top;" nowrap="nowrap" align="right" width="15%"><?=translate_text("Hình ảnh:")?></td>
        <td>
            <input type="file" name="go_picture" id="go_picture">
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" class="btn btn-sm btn-primary" name="upload" value="<?=translate_text("Thêm mới")?>" style="cursor:hand;" onClick="validateForm();">&nbsp;
            <input type="reset" class="form" value="<?=translate_text("Làm mới")?>" style="cursor:hand;">
        </td>
    </tr>

<?=$form->close_table()?>

<?=$form->close_form()?>

<?=template_bottom() ?>

<? /*------------------------------------------------------------------------------------------------*/ ?>

</body>





