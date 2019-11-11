<?
require_once("inc_security.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<?
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "arr", "POST", array());
	checkAddEdit("edit");
	foreach($record_id as $i=>$record){
		//Call Class generate_form();
		$myform = new generate_form();
		$myform->add("tra_text","val_" . $record,0,0,"",0,"",0,"");
		$myform->addTable("admin_translate");
		$db_ex = new db_execute($myform->generate_update_SQL("tra_keyword","'" . $record . "'"));
		unset($db_ex);
	}
	redirect($_SERVER['REQUEST_URI']);
}
?>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Language Administrator"))?>
		<? /*---------Body------------*/ ?>
		<?
		$db_translate = new db_query("DELETE FROM admin_translate WHERE TRIM(tra_text) = ''");
		$db_translate = new db_query("SELECT * FROM admin_translate ORDER BY tra_text ASC");
		?>
		<div class="listing">
			<div id="content" class="content">
				<table class="table table-bordered">
					<tr class="warning">
						<td width="20" class="h">STT</td>
						<td width="20" class="h"></td>
						<td class="h" width="100">Từ khóa</td>
						<td class="h" width="200">Sửa đổi</td>
						<td class="h" width="30">Hủy</td>
					</tr>
					<form action="translate.php" method="post">
						<input type="hidden" name="iQuick" value="update" />
						<?
						$stt = 0;
						while($row=mysqli_fetch_assoc($db_translate->result)){
							$stt++;
							?>
							<tr bgcolor="#f8f8f8">
								<td><?=$stt?></td>
								<td width="20" align="center"><input type="checkbox" name="record_id[]" id="<?=$row["tra_keyword"]?>" value="<?=$row["tra_keyword"]?>" /></td>
								<td><?=$row["tra_source"]?></td>
								<td><input type="text" name="val_<?=$row["tra_keyword"]?>" id="val_<?=$row["tra_keyword"]?>" onkeypress="check_edit('<?=$row["tra_keyword"]?>')" value="<?=$row["tra_text"]?>" maxlength="255" class="form-control" style="width:98%; border:solid 1px #D1DEEF" /></td>
								<td width="30" align="center"><img src="<?=$fs_imagepath?>delete.gif"  border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["tra_keyword"]?>'}" style="cursor:pointer"></td>
							</tr>
							<?
						}
						?>
						<tr>
							<td colspan="6">
								<input type="submit" name="Translate" class="btn btn-primary btn-sm" value="<?=translate_text("save_change")?>" />
								<input type="hidden" name="Action" value="Translate" />
							</td>
						</tr>
					</form>
				</table>
			</div>
		</div>
		<? /*---------Body------------*/ ?>
<?=template_bottom()?>
</body>
</html>