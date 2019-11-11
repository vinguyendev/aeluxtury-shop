<?
require_once("inc_security.php");
$list    =  new fsDataGird($id_field,$name_field,translate_text("Listing"));
$list->quickEdit = false;

$list->add("pra_icon_img", translate_text("Ảnh"), "picture", 1, 0);
$list->add($name_field,translate_text("Tên thuộc tính"),"string",0,0);
$list->add("pra_order","Thứ tự","string",1,0);
$list->add("pra_date","Date","date",1,0);
$list->add("pra_status","Active","checkbox");
$list->add("pra_show_home","Show home","checkbox");
$list->add("",translate_text("Edit"),"edit");
$list->add("",translate_text("Delete"),"delete");
$list->ajaxedit($fs_table);

$total 	= 0;
$db_count		= new db_query("SELECT count(*) AS count
									FROM " . $fs_table . "
									WHERE 1 " . $list->sqlSearch());
if($row = mysqli_fetch_assoc($db_count->result)){
	$total 	= $row['count'];
}
unset($db_count);

$db_listing = new db_query(" SELECT *
									 FROM " . $fs_table . "
									 WHERE 1 " . $list->sqlSearch() . "
									 ORDER BY " . $list->sqlSort() ." pra_id DESC
									 " . $list->limit($total));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?=$list->headerScript()?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
		<? /*---------Body------------*/ ?>
      <div id="listing" class="listing">
			<?=$list->showTable($db_listing,$total)?>
      </div>
		<? /*---------Body------------*/ ?>
</body>
</html>