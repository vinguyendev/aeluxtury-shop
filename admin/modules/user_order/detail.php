<?
include ("inc_security.php");

$fs_redirect			= getValue("url","str","GET",base64_encode("listing.php"));
$ord_id					= getValue("ord_id");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?=$load_header?>
<style type="text/css">
	table tr td{
		padding: 3px;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div class="listing">
	<center>
	<table border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse; margin: 20px;" width="90%">
		<tr>
			<td>STT</td>
			<td>Sản phẩm</td>
			<td>Ảnh</td>
			<td>Số lượng</td>
			<td>Giá</td>
			<td>Thành tiền</td>
		</tr>
	<?
	$i = 1;
	$db_sel = new db_query("SELECT * FROM orders_detail LEFT JOIN products ON (odd_product_id = pro_id) WHERE odd_order_id = ". $ord_id);
	while ($row = mysqli_fetch_assoc($db_sel->result)) {
		$url_image = getUrlImageProduct($row['pro_picture'], "small");
		?>
			<tr>
				<td><?=$i?></td>
				<td>
					<?=$row['pro_name']?><br/>
				<!-- 	Color: <?=isset($arrColor[$row['odd_color']]) ? $arrColor[$row['odd_color']] : "" ?> -->
				</td>
				<td><img width="100px" src="<?=$url_image?>"></td>
				<td><?=$row['odd_quantity']?></td>
				<td><?=number_format($row['odd_prices'])?> VNĐ</td>
				<td><?=number_format($row['odd_prices'] * $row['odd_quantity'])?> VNĐ</td>
			</tr>
		<?
		$i++;
	}
	unset($db_sel);
	?>
	</table>
	</center>
</div>
</body>
</html>
