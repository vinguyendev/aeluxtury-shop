<?
require_once("inc_security.php");
$list							= new fsDataGird($id_field,$name_field,translate_text("Danh sách liên hệ"));
$in							= getValue("in");
 
//$list->arrayFieldLevel	= array($name_field=>"-- ","cit_order"=>"-- ");
/*
1: Ten truong trong bang
2: Tieu de header
3: kieu du lieu
4: co sap xep hay khong, co thi de la 1, khong thi de la 0
5: co tim kiem hay khong, co thi de la 1, khong thi de la 0
*/
$list->add($id_field,"ID","numbernotedit",1,1);
$list->add("com_picture","Ảnh","picture",0,0);
$list->add($name_field,"Tên khách ","string",0,1,"");
$list->add("com_address","Địa chỉ","string",0,1);
$list->add("com_comment","Nội dung","string",0,1);
$list->add("com_date","Ngày tạo","date",0,0);
$list->add("com_active","Active","checkbox",0,0);

//$list->add("",translate_text("Copy"),"copy");
$list->add("",translate_text("Edit"),"edit");
//$list->ajaxedit($fs_table);

$sql 		= $list->sqlSearch();
// $menu		= new menu();
// $listAll	= $menu->getAllChild($fs_table,$id_field,"utl_parent_id","0","1" . $sql,"utl_id, utl_name, utl_active","utl_id ASC","");
$listAll  = array();
$db_query = new db_query("SELECT * 
								 FROM " . $fs_table .
								" WHERE 1 ORDER BY ". $id_field." ASC");
while ($row =  mysqli_fetch_assoc($db_query->result)) {
	$listAll[] = $row;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?=$load_header?>
<?=$list->headerScript()?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div id="listing" class="listing">
  <?=$list->showTableMulti($listAll)?>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>