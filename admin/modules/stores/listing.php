<?
require_once("inc_security.php");

	//gọi class DataGird
	$sto_city	= $array_city;
	$list			= new fsDataGird($id_field,$name_field,translate_text("Banner Listing"));
	$list->add($name_field, translate_text("Tên đại lý"), "string", 0, 1);
	$list->add("sto_city", translate_text("Tỉnh thành"), "array", 0, 1);
	$list->add("sto_address", translate_text("Address"), "string", 0, 0);
	$list->add("sto_phone", translate_text("Phone"), "string", 0, 0);
	$list->add("sto_order", translate_text("Order"), "number", 1, 0, "width=20px");
   $list->add("sto_date", "Ngày tạo", "date_all", 0, 0);
   $list->add("sto_active", "Active", "checkbox", 0, 0);
	$list->add("",translate_text("Edit"),"edit");
	$list->ajaxedit($fs_table);

	$sqlSearch	= $list->sqlSearch();

	$db_count		= new db_query("SELECT count(*) AS count
										FROM " . $fs_table . "
										WHERE 1 " . $sqlSearch);
	$total	= 0;
	if($row = mysqli_fetch_assoc($db_count->result)){
		$total 	= intval($row['count']);
	}
	unset($db_count);

	$db_listing = new db_query("SELECT *
										 FROM " . $fs_table . "
										 WHERE 1 " . $sqlSearch . "
										 ORDER BY " . $list->sqlSort() . $id_field . " DESC
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
<? /*---------Body------------*/?>
</body>
</html>