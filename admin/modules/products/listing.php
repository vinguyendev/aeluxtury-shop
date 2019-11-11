<?
require_once("inc_security.php");

$sqlWhere   = '';
$iCat				= getValue("iCat");
$iSource			= getValue("iSource");
$iSeason			= getValue("iSeason");
$iTime			= getValue("iTime");
$tou_keyword	= getValue('tou_keyword', "str", "GET", "", 1);
$tou_code		= getValue('tou_code', "str", "GET", "", 1);
$nActive			= getValue("nActive", "int", "GET", 0);

if($iSource > 0) $sqlWhere 	.= " AND tou_source_id = " . $iSource;
if($iSeason > 0) $sqlWhere 	.= " AND tou_source_id = " . $iSeason;
if($iTime > 0) $sqlWhere 	.= " AND tou_times_id = " . $iTime;

// Filter deal active
if($nActive != 0){
	switch ($nActive) {
		case 1:
			$sqlWhere .= " AND pro_active = 1 ";
			break;
		case 2:
			$sqlWhere .= " AND pro_active = 0 ";
			break;
		default:
			$sqlWhere .= "";
			break;
	}
}

//Search theo danh muc
if($iCat != 0){
	$db_cat	= new db_query("SELECT cat_id, cat_all_child, cat_has_child
									 FROM categories_multi
									 WHERE cat_id = " . $iCat,
									 __FILE__);
	if($rowType	= mysqli_fetch_assoc($db_cat->result)){
  		$all_cat = $rowType['cat_all_child'];

		if($all_cat != ""){
			$sqlWhere	.= " AND pro_category_id IN ( " . convert_list_to_list_id($all_cat) . ")";
		}
	}
}

// Search từ khóa
if($tou_keyword != ""){
	$sqlWhere	.=	" AND pro_name LIKE '%" .	$tou_keyword	. "%'";
}

// Query sắp xếp
$sql_order	= " ORDER BY pro_id DESC";
$url 			= getURL(0,1,1,1,"sort|sortname");
$array_order= array(	"pro_active" => array("name" => "pro_active"),
						"pro_hot" => array("name" => "pro_hot"),
						"pro_order" => array("name" => "pro_order")
							);
foreach($array_order as $key => $value){
	$array_order[$key]['url']	= $url . "&sort=asc&sortname=" . $key;
	$array_order[$key]['img']	= 	'sort.gif';
}

$sort 		= getValue("sort", "str", "GET", "", 1);
$sortname 	= getValue("sortname", "str", "GET", "", 1);
$img			= 'sort.gif';
if(!isset($array_order[$sortname])){
	$sort = "";
}
switch($sort){
	case "asc":
		$sql_order	= " ORDER BY " . $sortname ." " . $sort;
		$url 	= $url . "&sort=desc&sortname=" . $sortname;
		$img	= 'sort-asc.gif';
	break;
	case "desc":
		$sql_order	= " ORDER BY " . $sortname . " " . $sort;
		$url 	= $url . "&sort=asc&sortname=" . $sortname;
		$img	= 'sort-desc.gif';
	break;
	default:
		$url 	= $url . "&sort=asc&sortname=" . $sortname;
		$img	= 'sort.gif';
	break;
}

$array_order[$sortname]['url']	= $url;
$array_order[$sortname]['img']	= $img;

// Phân trang
$page_size			= 30;
$page_prefix		= "Trang: ";
$normal_class		= "page";
$selected_class	= "page_current";
$previous			= '<img align="absmiddle" border="0" src="../../resource/images/grid/prev.gif">';
$next          	= '<img align="absmiddle" border="0" src="../../resource/images/grid/next.gif">';
$first				= '<img align="absmiddle" border="0" src="../../resource/images/grid/first.gif">';
$last          	= '<img align="absmiddle" border="0" src="../../resource/images/grid/last.gif">';
$break_type			= 1;
$url					= getURL(0,0,1,1,"page");
$total_quantity	= 0; // tổng sô lượng
$db_count			= new db_query("  SELECT count(*) AS count
												FROM " . $fs_table . "
												WHERE 1 " . $sqlWhere,
												__FILE__);

$listing_count		= mysqli_fetch_assoc($db_count->result);
$total_record		= $listing_count["count"];
$current_page		= getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
unset($db_count);
//End phân trang

$db_listing	= new db_query("	SELECT *
										FROM " . $fs_table . "
										LEFT JOIN categories_multi ON(cat_id = pro_category_id AND cat_type = 'product')
										LEFT JOIN admin_user ON(adm_id = " . $fs_table . ".admin_id)
										WHERE 1 " . $sqlWhere . $sql_order ."
										LIMIT " . ($current_page-1) * $page_size . "," . $page_size,
										__FILE__);
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
					<td class="h">Thông tin</td>
					<td class="h">Diện tích</td>
					<td class="h">Action</td>
					<td class="h">Thông tin khác</td>
				</tr>
				<?
				$No	= ($current_page - 1) * $page_size;
			   while($listing = mysqli_fetch_assoc($db_listing->result)) {
			      $No++;
					// Link đến trang chi tiết
					$urlpreview = createlink("product_detail",array("iCat"=>$listing["pro_category_id"], "iData" => $listing["pro_id"], "nTitle" => $listing["pro_name"]));
					$background_tr	= "background:#FFFFFF";
					if($No%2 == 0) $background_tr	= "background:#F9F9F9";
					$picture_product 	= getUrlImageProduct($listing['pro_picture'], "medium");
				 	?>
					<tr id="tr_<?=$listing["pro_id"]?>" style="<?=$background_tr?>">
						<td title="stt"><b><?=$No?></b></td>
						<td align="center" valign="middle" style="vertical-align: middle;">
							<a href="<?=$urlpreview?>" border="0" target="_blank"><img src="<?=$picture_product?>" width="100"/>
						</td>

						<td title="Thông tin" align="left" valign="top">
							<table cellpadding="1" class="table_small">
								<tr>
									<td width="80px" valign="top">Tiêu đề</td>
									<td><a href="<?=$urlpreview?>" target="_blank"><?=$listing["pro_name"]?></a></td>
								</tr>
								<tr>
									<td>Danh mục</td>
									<td><?=$listing['cat_name']?></td>
								</tr>
							
							</table>
						</td>
						<td title="Giá Tour" align="left" valign="top">
							<table cellpadding="1" class="table_small">
								<tr style="color: #999">
									<td width="140px" nowrap="nowrap">Diện tích</td>
									<td nowrap="nowrap">: <?=formatCurrency($listing["pro_mil"])?> m2</td>
								</tr>
								
							</table>
						</td>
						<td valign="top">
							<table cellpadding="1" width="180px" class="table_small">
								<tr>
									<td>Edit</td>
									<td>
										<a style="font-size: 14px;" href="add.php?record_id=<?=$listing['pro_id']?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>" class="noborder glyphicon glyphicon-edit"></a>
									</td>
								</tr>
								<tr>
									<td>Hot</td>
									<td>
										<a onclick="update_check_ajax('action_hot', <?=$listing['pro_id']?>);" id="action_hot_<?=$listing['pro_id']?>">
											<?if($listing['pro_hot'] == 1){
												echo '<img border="0" src=" ../../resource/images/grid/check_1.gif" />';
											}else{
												echo '<img border="0" src=" ../../resource/images/grid/check_0.gif" />';
											}?>
										</a>
									</td>
								</tr>
								<tr>
									<td>Active</td>
									<td>
										<a onclick="update_check_ajax('action_active', <?=$listing['pro_id']?>);" id="action_active_<?=$listing['pro_id']?>">
											<?if($listing['pro_active'] == 1){
												echo '<img border="0" src=" ../../resource/images/grid/check_1.gif" />';
											}else{
												echo '<img border="0" src=" ../../resource/images/grid/check_0.gif" />';
											}?>
										</a>
									</td>
								</tr>
							</table>
						</td>
						<td title="Thông tin khác" align="left" valign="top">
							<table cellpadding="1" class="table_small" width="200">
								<tr>
									<td nowrap="nowrap">Ngày tạo</td>
									<td><?=date("H:i:s d/m/Y", $listing['pro_create_time'])?></td>
								</tr>
								<tr>
									<td nowrap="nowrap" valign="top">Cập nhật</td>
									<td>
										<div><?=date("H:i:s d/m/Y", $listing['pro_update_time'])?></div>
										<div>By: <?=$listing['adm_name'] . ' (' . $listing['adm_loginname'] . ') '?></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
			<? } ?>
		</table>
	</div>

	<div class="footer">
		<table width="100%" class="page_break">
			<tr>
				<td style="color: #15428B; font-weight: bold;">Tổng số bản ghi: <span style="color: #333333;"><?=$total_record?></span></td>
				<td width="150"></td>
				<td></td>
				<? if($total_record > $page_size){ ?>
					<td><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
				<? } ?>
				<td align="right"><a title="Go to top" accesskey="T" class="top" href="#" style="font-weight: bold;">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.png" /></a></td>
			</tr>
		</table>
	</div>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
<? unset($db_listing); ?>

<script type="text/javascript">
	function update_check_ajax(type, id){
		id	= parseInt(id);
		if(type && id){
			var content_html	= $("#" + type + "_" + id).html();
			$("#" + type + "_" + id).html('<img border="0" src=" ../../resource/images/grid/indicator.gif">');
			$.post("active.php", {
				type:type,
				record_id: id
			}, function(json){
				if(json.data != "" && json.msg == ""){
					$("#"+type+"_"+id).html(json.data);
				}else{
					$("#"+type+"_"+id).html(content_html);
					alert(json.msg);
				}
			}, 'json');
		}
	}
</script>