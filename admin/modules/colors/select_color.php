<?
include ("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
$record_id	= getValue("record_id", "int", "GET", 0);

// Lấy thông tin bản ghi này
$infoColor 	= array();
$db_query 	= new db_query("SELECT * FROM colors WHERE col_id = " . $record_id . " LIMIT 1");
if($row = mysqli_fetch_assoc($db_query->result)){
	$infoColor 	= $row;
}else{
	die("Color not found!");
}
unset($db_query);

$col_json_info 	= $infoColor['col_json_info'];
$dataJsonInfo 		= ($col_json_info != "") ? json_decode(base64_decode($col_json_info), 1) : array();

$action = getValue("action", "str", "POST", "");
if($action == "execute"){
	$listColor 	= getValue("color_code", "str", "POST", "", 3);
	$listColor	= explode(",", $listColor);
	$arrColor 	= array();
	if(is_array($listColor)){
		foreach ($listColor as $key => $value) {
			$value = strtoupper(trim($value));
			if($value != "") $arrColor[$value] = "'" . $value . "'";
		}
	}

	if($arrColor){
		$arrInsert 	= array();
		$db_check 	= new db_query("SELECT col_id FROM colors WHERE col_code IN(" . implode(",", $arrColor) . ")");
		while($row = mysqli_fetch_assoc($db_check->result)){
			$arrInsert[] = $row['col_id'];
		}
		unset($db_check);

		if($arrInsert){
			$strColor						= implode(",", $arrInsert);
			$dataJsonInfo['color_sub']	= $strColor;
			$db_update 	= new db_execute("UPDATE colors SET col_json_info = '" . base64_encode(json_encode($dataJsonInfo)) . "' WHERE col_id = " . $infoColor['col_id']);
			unset($db_update);
			$infoColor['col_json_info'] 	= base64_encode(json_encode($dataJsonInfo));
		}
	}
}

$color_sub		= isset($dataJsonInfo['color_sub']) ? $dataJsonInfo['color_sub'] : '';
$arrColorSub	= array();
if($color_sub){
	$db_query 	= new db_query("SELECT * FROM colors WHERE col_id IN(" . convert_list_to_list_id($color_sub) . ")");
	while($row = mysqli_fetch_assoc($db_query->result)){
		$arrColorSub[$row['col_code']] 	= $row;
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
<? /*---------Body------------*/ ?>
<div id="listing" class="listing">
	<h3>Chọn màu nhấn cho màu: <?=$infoColor['col_code']?> <span style="vertical-align: text-bottom; display: inline-block; width: 60px; height: 28px; background: #<?=$infoColor['col_hex']?>">&nbsp;</span></h3>
 	<form action="" method="POST">
 		<table cellspacing="0" cellspacing="10">
 			<tr>
 				<td>
 					<div style="padding-bottom: 5px;">Nhập mã màu (cách nhau bởi dấu ,)</div>
 					<textarea class="form-control" name="color_code" id="" cols="50" rows="5" placeholder="" style="resize: none;"><?=(count($arrColorSub) > 0) ? implode(",", array_keys($arrColorSub)) : ''?></textarea>
 				</td>
 				<td valign="top" style="padding-left: 20px; padding-top: 21px;">
 					<input type="hidden" name="action" value="execute" />
 					<input class="btn btn-sm btn-primary" type="submit" value="<?=translate_text('Cập nhật')?>" />
 				</td>
 			</tr>
 			<tr>
 				<td colspan="2">
 					<?
 					if($arrColorSub){
 						echo '<div style="color: #1450ff; font-size: 13px; padding: 8px 0px;">Các màu nhấn đã chọn:</div>';
						foreach ($arrColorSub as $key => $value) {
							?>
							<span style="display: inline-block; margin-right: 5px; width: 50px; text-align: center; line-height: 50px; height: 50px; background: #<?=$value['col_hex']?>"><?=$value['col_code']?></span>
							<?
						}
					}
 					?>
 				</td>
 			</tr>
 		</table>
 	</form>
</div>
</body>
</html>