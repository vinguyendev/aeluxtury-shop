<?
require_once("inc_security.php");

	//gọi class DataGird
	$list = new fsDataGird($id_field,$name_field,translate_text("News Listing"));

	$sta_category_id	= array();
	$sev_parent_id = $arrSup;
	$list->add($name_field,translate_text("Title"),"string",1,1);
	$list->add("sev_parent_id","Danh mục","array",0,1);
	$list->add("sev_image","Ảnh","picture",0,1);
	$list->add("sev_hot",translate_text("Hot"), "checkbox");
	$list->add("sev_active",translate_text("Active"), "checkbox");
	$list->add("sev_create_time","Ngày tạo","date",1,1);
	$list->add("sev_update_time","Ngày sửa","date",1,1);
	$list->add("",translate_text("Edit"),"edit");
	$list->add("",translate_text("Delete"),"delete");

	$list->ajaxedit($fs_table);

	$total 		= 0;
	$db_count	= new db_query("SELECT count(*) AS count
											 FROM " . $fs_table . "
											 WHERE 1 " . $list->sqlSearch());
	if($row_count = mysqli_fetch_assoc($db_count->result)){
		$total	= $row_count['count'];
	}
	unset($db_count);
	$db_listing	= new db_query("SELECT *
										 FROM " . $fs_table . "
										 WHERE 1 " . $list->sqlSearch() . "
										 ORDER BY " . $list->sqlSort() . $id_field ." DESC
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