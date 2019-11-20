<?

include("inc_security.php");

$db_cate = new db_query("SELECT cate_id, cate_name FROM categories");

$arrCategory = array();

while($row = mysqli_fetch_assoc($db_cate->result))  $arrCategory[$row["cate_id"]] = $row["cate_name"];

?>

<form action="" method="GET">

    <div class="search">

        <table>

            <tr>

                <td valign="top">

                    <table width="100%" cellpadding="2">

                        <tr>

                            <td class="text">Tên sản phẩm</td>

                            <td>

                                <input type="text" id="tou_keyword" name="tou_keyword" class="form-control" style="width: 150px;"  />

                            </td>

                        </tr>

                    </table>

                </td>

                <td valign="top">

                    <table width="100%" cellpadding="2">

                        <tr>

                            <td class="text">Dòng sản phẩm</td>

                            <td>

                                <select id="iCat" class="form-control" name="iCat" style="width: 150px;">

                                    <option value="0">Chọn dòng sản phẩm</option>

                                    <? foreach ($arrCategory as $key => $value) { ?>
                                        <option value="<?= $key ?>"><?=$value?></option>
                                    <? } ?>

                                </select>

                            </td>

                        </tr>

                    </table>

                </td>



                <td valign="top">

                    <table width="100%" cellpadding="2">

                        <tr>

                            <td></td>

                            <td style="padding-top: 2px;">

                                <input style="width: 100%; font-weight: bold;" type="submit" class="btn btn-info" value="Tìm kiếm" />

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>

    </div>

</form>
