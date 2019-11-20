<?

require_once("inc_security.php");

$queryStr = "SELECT * FROM goods";

$db_listing = new db_query($queryStr);

function getNameCategory($id) {
    $query = "SELECT cate_name FROM categories WHERE cate_id = '$id' ";
    $db_result = new db_query($query);
    $result = mysqli_fetch_assoc($db_result->result);

    return $result["cate_name"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <?=$load_header?>

    <script language="javascript" src=" ../../resource/js/grid.js"></script>

</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>

<div class="listing">
    <div class="header">
        <?include("inc_search.php");?>
    </div>

    <div class="content">
        <table class="table table-bordered">
            <tbody>
                <tr class="warning">
                    <td width="30" class="h">STT</td>

                    <td class="h">Ảnh</td>

                    <td class="h">Code</td>

                    <td class="h">Tên</td>

                    <td class="h">Kích thước</td>

                    <td class="h">Action</td>

                    <td class="h">Dòng sản phẩm</td>

                    <td class="h">Giá</td>

                    <td class="h">Mô tả</td>

<!--                    <td class="h">Thao tác</td>-->
                </tr>
                <?
                $No	= 0;
                $background_tr	= "background:#FFFFFF";
                while($listing = mysqli_fetch_assoc($db_listing->result)) {
                $No++;
                    $background_tr	= "background:#FFFFFF";
                    if($No%2 == 0) $background_tr	= "background:#F9F9F9";

                    $picture_product = "images/".$listing["go_picture"];
                ?>
                <tr id="tr_<?=$listing["go_id"]?>" style="<?=$background_tr?>">
                    <td title="stt"><b><?=$No?></b></td>

                    <td align="center" valign="middle" style="vertical-align: middle;">

                        <a href="" border="0" target="_blank">
                            <img src="<?=$picture_product?>" width="100" height="100"/>
                        </a>
                    </td>
                    <td align="center" valign="middle">
                       <?=$listing["go_code"]?>
                    </td>
                    <td align="center" valign="middle">
                        <?=$listing["go_name"]?>
                    </td>
                    <td align="center" valign="middle">
                        <?=$listing["go_size"]?>
                    </td>
                    <td align="center" valign="middle">
                        <?=$listing["go_active"]?>
                    </td>
                    <td align="center" valign="middle">
                        <?=$listing["go_name"]?>
                    </td>
                    <td align="center" valign="middle">
                        <?=getNameCategory($listing["go_category_id"])?>
                    </td>
                    <td align="center" valign="middle">
                        <?=$listing["go_description"]?>
                    </td>
<!--                    <td width="64">-->
<!--                        <a  href="edit.php?record_id=--><?//=$listing["go_id"]?><!--&returnurl=--><?//=base64_encode(getURL())?><!--" style="margin-right: 10px">-->
<!--                            <img src="--><?//=$fs_imagepath?><!--edit.png" alt="EDIT" border="0">-->
<!--                        </a>-->
<!--                        <a  href="delete.php?record_id=--><?//=$listing["cat_id"]?><!--&returnurl=--><?//=base64_encode(getURL())?><!--">-->
<!--                            <img src="--><?//=$fs_imagepath?><!--delete.gif" alt="DELETE" border="0">-->
<!--                        </a>-->
<!--                    </td>-->
                </tr>
                <? } ?>
            </tbody>
        </table>
    </div>
</div>

<? /*---------Body------------*/ ?>

</body>

</html>