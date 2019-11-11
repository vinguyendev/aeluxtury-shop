<?
require_once("inc_security.php");

$fs_title	=	"Listing Translate";

//Câu lệnh search
$sql_search	= "";
$tra_source	= getValue("tra_source", "str", "GET", "", 1);
$lang_id		= getValue("lang_id", "int", "GET", 0);
if($tra_source != ""){
	$sql_search	.= " AND ust_text LIKE '%".	$tra_source	."%'";
}
if($lang_id){
	$sql_search	.= " AND lang_id =".	$lang_id;
}
$page_size			= 4;
$page_prefix		= "Trang: ";
$normal_class		= "page";
$selected_class	= "page_current";
$previous			= "<";
$next          	= ">";
$first				= "|<";
$last          	= ">|";
$break_type			= 1;
$url					= getURL(0,0,1,1,"page");
$total_quantity	=	0; // tổng sô lượng
$db_count			= new db_query("SELECT count(*) AS count
	      								 FROM " . $fs_table . "
	      								 WHERE 1 ".	$sql_search);

//	LEFT JOIN users ON(usp_user_id = use_id)
$listing_count		= mysqli_fetch_assoc($db_count->result);
$total_record		= $listing_count["count"];
$current_page		= getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
unset($db_count);

$db_listing	= new db_query("SELECT *
   								 FROM " . $fs_table . "
   								 WHERE 1	".	$sql_search	."
   								 ORDER BY ust_date ASC
   								 LIMIT " . ($current_page-1) * $page_size . "," . $page_size);

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
		<h3><?=translate_text('Admin Translate Listing')?></h3>
		<form action="" method="GET">
			<div class="search">
				<select class="form-control" name="lang_id" id="lang_id" onchange="change_lang()">
		      	<option value="0">- Ngôn ngữ -</option>
		      	<?
					foreach ($list_language as $key => $value) {
						$selected =  ($lang_id == $key) ? 'selected="selected" ' : '';
						echo '<option  '. $selected .' value="'. $key .'">'. $value .'</option>';
					}
					?>
		      </select>
				Từ khóa&nbsp;<input class="form-control" type="text" name="tra_source" id="tra_source" value="<?=$tra_source?>"/>
				<input class="btn btn-primary btn-xs" type="submit" value="Tìm kiếm" class="bottom"/>
			</div>
		</form>
	</div>

	<div class="content">
		<table class="table table-bordered">
			<tr class="warning">
				<td width="30" class="h">STT</td>
				<td class="h" width="200">Từ khóa</td>
				<td class="h" width="200">Lang</td>
				<td class="h" width="200">Translate</td>
				<td class="h" width="100">Date</td>
				<td class="h" width="40">Edit</td>
				<td class="h" width="40">Hủy</td>
			</tr>
			<?
			$No = ($current_page - 1) * $page_size;
		   while($listing = mysqli_fetch_assoc($db_listing->result)) {
		      $No++;
               ?>
				<tr>
					<td title="stt" <?=$listing['ust_date'] == 0 ? "style='background: yellow'" : ""?>><b><?=$No?></b></td>
					<td title="ust_source"><b><?=$listing["ust_source"]?></b></td>
					<td title="lang"><b><?=$list_language[$listing['lang_id']]?></b></td>
					<td title="ust_text"><?=$listing["ust_text"]?></td>
					<td align="center"><?=date("d/m/Y", $listing['ust_date'])?></td>
					<td align="center"><a href="edit.php?record_id=<?=$listing['ust_id']?>&lang_id=<?=$listing['lang_id']?>"><img border="0" src="../../resource/images/grid/edit.png"></a></td>
					<td align="center"><a href="delete.php?record_id=<?=$listing['ust_id']?>&lang_id=<?=$listing['lang_id']?>"><img border="0" src="../../resource/images/grid/delete.gif"></td>
				</tr>
				<?
			}
			unset($db_listing);
			?>
		</table>
	</div>

	<div class="footer">
		<?
		if($total_record > $page_size){
			?>
			<table width="100%" class="page_break">
				<tr>
					<td><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
				</tr>
			</table>
			<?
		}
		?>
	</div>
</div>

</body>
</html>