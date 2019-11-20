<?
    if(isset($_POST['go_id'])) {
        $go_id = $_POST['go_id'];
        $queryGo = "SELECT * FROM goods WHERE go_id = ".$go_id;
        $db_good = new db_query($queryGo);

        $good = mysqli_fetch_assoc($db_good->result);
    }

    $picture_product = "../admin/modules/goods/images/".$good["go_picture"];

    var_dump($good);die;
?>

<div class="show-detail-left">
    <img src="<?=$picture_product?>">
</div>
<div class="show-detail-right">
    <h1><?=$good["go_name"]?></h1>
    <p><?=$good["go_code"]?></p>
    <hr>
    <p><?=$good["go_description"]?></p>
    <br>
    <div class="hr"></div>
    <br>
    <div class="size-price-product">
        <span><?=$good["go_size"]?></span>
        <span><?=$good["go_price"]?> VNÐ</span>
    </div>
</div>
