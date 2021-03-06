<?
require_once("inc_security.php");

$name_branch		= getValue("name_branch", "str", "GET", "", 1);

$sqlWhere	= "";
if($name_branch != "" && $name_branch != ""){
	$sqlWhere	.= " AND bra_name LIKE '%" . $name_branch . "%'";
}

//Get page break params
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
$total_quantity	= 0; //

$db_count			= new db_query("  SELECT count(*) AS count
												FROM " . $fs_table . "
												WHERE 1 ". $sqlWhere,
												__FILE__,
												"USE_SLAVE");
$listing_count		= mysqli_fetch_assoc($db_count->result);
$total_record		= $listing_count["count"];
$current_page		= getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
unset($db_count);
//End get page break params

$db_listing	= new db_query("	SELECT *
										FROM " . $fs_table . "
										WHERE 1 ". $sqlWhere . "
										ORDER BY bra_id DESC
										LIMIT " . ($current_page-1) * $page_size . "," . $page_size,
										__FILE__,
										"USE_SLAVE");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div class="listing">
	<div class="header">
		<form action="" method="GET">
			<div class="search">
				<table class="table table_border_none">
					<tr>
						<td class="text" style="text-align: left">SEARCH: Tên thương hiệu:
							<input type="text" value="<?=$name_branch?>" id="name_branch" name="name_branch" class="form-control" />
							<input class="btn btn-xs btn-info " type="submit" value="Search" />
						</td>
					</tr>
				</table>
			</div>
		</form>

	</div>
	<div class="content">
		<table width="80%" cellspacing="0" cellpadding="0" class="table table-hover table-bordered">
				<tr class="warning">
					<td width="30" class="h">STT</td>
					<td class="h">Name</td>
					<td class="h">Active</td>
					<td class="h">Order</td>
					<td class="h">Create Time</td>
					<td class="h">Edit</td>
					<td class="h">Delete</td>
				</tr>
				<?
				$No	= ($current_page - 1) * $page_size;
				while($listing = mysqli_fetch_assoc($db_listing->result)) {
					$No++;
					?>
					<tr id="tr_<?=$listing["bra_id"]?>">
						<td title="STT" class="bold center"><?=$No?></td>
						<td title="Thông tin" valign="top">
							<?=$listing["bra_name"]?> 
							<img width="100px" src="/data/brands/<?=$listing["bra_picture"]?>">
						</td>
						<td title="Active" class="center" style="text-align: center;">
							<a onclick="update_check_ajax(<?=$listing['bra_id']?>,'bra_active');" id="bra_active_<?=$listing['bra_id']?>">
								<?if($listing['bra_active'] == 1){
									echo '<img border="0" src="../../resource/images/grid/check_1.gif" />';
								}else{
									echo '<img border="0" src="../../resource/images/grid/check_0.gif" />';
								}?>
							</a>
						</td>
						<td class="align_c"><?=$listing['bra_order']?></td>
						<td class="align_c"><?=date("H:i:s d/m/Y", $listing['bra_date'])?></td>
						<td  class="align_c" >
							<a href="edit.php?record_id=<?=$listing['bra_id']?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>" title="Bạn muốn sửa đổi bản ghi" >
								<img border="0" src="../../resource/images/grid/edit.png" />
							</a>
						</td>
						<td class="align_c">
							<a onclick="if (confirm('Bạn muốn xóa bản ghi?: <?=$listing['bra_name']?>')){ delete_branch(<?=$listing['bra_id']?>); }" class="delete">
								<img border="0" src="../../resource/images/grid/delete.gif">
							</a>
						</td>
					</tr>
			<? } ?>
		</table>
	</div>
	<div class="footer">
		<table class="page_break" width="100%">
			<tr>
				<td style="color: #15428B; font-weight: bold;">Tổng số bản ghi: <span style="color: #333333;"><?=$total_record?></span></td>
				<td width="150"></td>
				<td></td>
				<? if($total_record > $page_size){ ?>
					<td><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
				<? } ?>
				<td class="align_r"><a title="Go to top" accesskey="T" class="top" href="#" style="font-weight: bold;">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.png"></a></td>
			</tr>
		</table>
	</div>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
<? unset($db_listing); ?>

<script type="text/javascript">
	function update_check_ajax(id,field_type){
		id	= parseInt(id);
		if(id){
			$.post("active.php", {
				record_id: id,
                type : field_type
			}, function(json){
				if(json.code == 1){
					$("#"+field_type+"_"+id).html(json.data);
				}else{
					alert(json.data);
				}
			}, 'json')
		}
	}
	function delete_branch(id){
		id	= parseInt(id);
		if(id){
			$.post("delete.php", {
				record_id: id
			}, function(json){
				if(json.status == 1){
					alert(json.msg);
					$("#tr_"+id).hide();
				}else{
					alert(json.msg);
				}
			}, 'json')
		}
	}

	/* get city child */
	$('#use_city_p').change(function(){
		var city_id	= $(this).val() || 0;
		if(city_id > 0){
			$.post(
				'city_child.php',
				{iCit : city_id},
				function(data){
					if(data.html != ''){
						$('#use_city_c').html(data.html);
					}else{
						alert('No data');
					}
				},
				'json'
			)
		}
	});
</script>
