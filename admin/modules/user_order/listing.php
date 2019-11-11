<?
require_once("inc_security.php");

$sqlWhere 	= "";

$email_search 	= getValue("email_search","str","GET", "");
if($email_search  != ""){
	$sqlWhere .= " AND ord_email = '" . $email_search . "' ";
}

$name_search 	= getValue("name_search","str","GET", "");
if($name_search  != ""){
	$sqlWhere .= " AND ord_name LIKE '%" . $name_search . "%' ";
}

$method_pay 	= getValue("method_pay","str","GET", "");
if($method_pay  != ""){
	$sqlWhere .= " AND ord_method_pay LIKE '%" . $method_pay . "%' ";
}

$uso_status 	= getValue("uso_status","int","GET", -2);
if($uso_status != -2){
	$sqlWhere .= " AND ord_status = " . $uso_status . " ";
}

// Mặc định lấy 30 ngày đến thời điểm hiện tại
$time_current       	= date('d/m/Y', (time() - 30*24*60*60));
$value_date_start 	= getValue("start","str","GET", $time_current);

$value_date_end      = getValue("end","str","GET","dd/mm/yy");

if($value_date_start != "dd/mm/yy"){
	$sqlWhere .= ' AND ord_date >= ' . convertDateTime($value_date_start, "00:00:00");
}
if($value_date_end != "dd/mm/yy"){
	$sqlWhere .= ' AND ord_date <= ' . convertDateTime($value_date_end, "23:59:59");
}

//Khai báo biến khi hiển thị danh sách
$fs_title    = "Danh sách Đơn hàng";
$fs_action   = "listing.php" . getURL(0,0,0,1,"record_id");
$fs_redirect = "listing.php" . getURL(0,0,0,1,"record_id");
$fs_errorMsg = "";

$record_id   = getValue("record_id");
$sqlOrderBy  = ' ord_id DESC ';

$arrAdm      = array();
$db_user     = new db_query("SELECT * FROM admin_user WHERE adm_active = 1");
while ($row_adm = mysqli_fetch_assoc($db_user->result)) {
	$arrAdm[$row_adm['adm_id']] = $row_adm['adm_loginname'];
}
unset($db_user);

//Get page break params
$page_size      = 30;
$page_prefix    = "Trang: ";
$normal_class   = "page";
$selected_class = "page_current";
$previous       = '<img align="absmiddle" border="0" src="../../resource/images/grid/prev.gif">';
$next           = '<img align="absmiddle" border="0" src="../../resource/images/grid/next.gif">';
$first          = '<img align="absmiddle" border="0" src="../../resource/images/grid/first.gif">';
$last           = '<img align="absmiddle" border="0" src="../../resource/images/grid/last.gif">';
$break_type     = 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$url            = getURL(0,0,1,1,"page");

$db_count			= new db_query("SELECT COUNT(*) AS count
	         								FROM " . $fs_table . "
	                                 WHERE 1 " . $sqlWhere);

//	LEFT JOIN users ON(uso_user_id = use_id)
$listing_count		= mysqli_fetch_array($db_count->result);
$total_record		= $listing_count["count"];
$current_page		= getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
unset($db_count);
//End get page break params

$db_listing	= new db_query("  SELECT *
         							FROM " . $fs_table . "
         							WHERE 1 " . $sqlWhere . "
         							ORDER BY " . $sqlOrderBy . "
         							LIMIT " . ($current_page-1) * $page_size . "," . $page_size,
										__FILE__);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?=$load_header?>

<script language="javascript" src="../../resource/js/grid.js"></script>
</head>
<body style="font-size: 11px !important;" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<div id="show"></div>
<? /*---------Body------------*/ ?>
<?=template_top("Danh sách đơn hàng")?>
<div class="listing">
	<div class="header">
		<form action="" method="GET">
			<div class="search">
				<table>
					<tr>
						<td>
							<table>
								<tr>
									<td class="text">Email:</td>
									<td>
										<input type="text" value="<?=$email_search?>" id="email_search" name="email_search" class="form-control date"/>
									</td>
								</tr>
								<tr>
									<td class="text">Name:</td>
									<td>
										<input type="text" value="<?=$name_search?>" id="name_search" name="name_search" class="form-control date"/>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td class="text">Từ:</td>
									<td>
										<input type="text"  class="form-control date" name="start" id="start" onKeyPress="displayDatePicker('start', this);" onClick="displayDatePicker('start', this);" onfocus="if(this.value=='dd/mm/yyyy') this.value=''" onblur="if(this.value=='') this.value='dd/mm/yyyy'" value="<?=$value_date_start?>"/>
									</td>
								</tr>
								<tr>
									<td class="text">Đến:</td>
									<td>
										<input type="text"  class="form-control date" name="end" id="end" onKeyPress="displayDatePicker('end', this);" onClick="displayDatePicker('end', this);" onfocus="if(this.value=='dd/mm/yyyy') this.value=''" onblur="if(this.value=='') this.value='dd/mm/yyyy'" value="<?=$value_date_end ?>"/>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td class="text">Hthức TT:</td>
									<td>
										<select id="method_pay" name="method_pay" class="form-control date">
											<option value="">Tất cả</option>
											<? foreach($array_method_pay as $key => $value){ ?>
											<option value="<?=$key?>" <? if($method_pay == $key) echo 'selected="selected"';?>><?=$value?></option>
											<? } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="text">Trạng thái:</td>
									<td>
										<select id="uso_status" name="uso_status" class="form-control date">
											<option value="-2" <? if($uso_status == -2) echo 'selected="selected"';?>>Tất cả</option>
											<? foreach($arrayStatus as $key => $value){ ?>
											<option value="<?=$key?>" <? if($uso_status == $key) echo 'selected="selected"';?>><?=$value?></option>
											<? } ?>
										</select>
									</td>
								</tr>
							</table>
						</td>

						<td valign="top">
							<table>
								<tr>
									<td></td>
									<td><input style="width: 100px;" class="btn btn-small btn-info" type="submit" value="Tìm kiếm" /></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
	<script type="text/javascript">function check_form_submit(obj){ document.form_search.submit(); };</script>

	<div class="content">
		<div>
			<div style="clear: both;"></div>
			<table width="100%" cellspacing="0" cellpadding="0"  class="table table-bordered">
					<tr class="warning">
						<td class="h" width="5px">STT</td>
						<td class="h" width="180px">Thông tin khách hàng</td>
						<td class="h" width="80px">Thông tin đơn hàng</td>
						<td class="h" width="180px">Ngày đặt hàng</td>
						<td class="h" width="200px">Action</td>
						<td class="h" width="200px">Ghi chú</td>
					</tr>
				<?
				//Đếm số thứ tự
            $No         = ($current_page - 1) * $page_size;
				while($listing = mysqli_fetch_array($db_listing->result)) {

               $use_email  = $listing["ord_email"];
               $use_name   = $listing["ord_name"];
               $use_phone  = $listing["ord_phone"];

               $No++;
               $bg_color	= "";
					?>
					<tr id="tr_<?=$listing["uso_id"]?>" style="<?=$bg_color?>">
						<td title="STT" align="center"><b><?=$No?></b></td>
						<td title="Thông tin khách hàng" valign="top">
							<div style="padding: 5px; line-height: 18px;">
		                     Họ và tên   : <b><a><?=$use_name?></a></b><br />
		                     Điện thoại  : <b><a><?=$use_phone?></a></b><br />
		                     Email       : <b><a><?=$use_email?></a></b><br />

		                     Địa chỉ       : <b><?=$arrCity[$listing['ord_city']]?> - <?=$arrCity[$listing['ord_district']]?> - <a><?=$listing['ord_address']?></a></b><br />
							</div>

							</div>
						</td>
						<td align="left" valign="top">
							<div style="padding: 5px; line-height: 18px;">
								Hình thức thanh toán : <b><?=isset($array_method_pay[$listing['ord_method_pay']]) ? $array_method_pay[$listing['ord_method_pay']] : ""?></b></br>
								<?
								if($listing['ord_method_pay'] > 0){
									?>
									Giảm giá: <b><?=format_number($listing["ord_promotion"], 0)?></b> VNĐ</br>
									<?
								}
								?>

								Tổng tiền: <b><?=format_number($listing["ord_payment"], 0)?></b> VNĐ</br>
								Trạng thái giao dịch: <b><?=$listing["ord_note"]?></b> </br>

							</div>
						</td>
						<td align="" valign="center">
							<b><?=date("d/m/Y H:i:s", $listing["ord_date"])?></b></br>
							<b>Người xử lý: <?=isset($arrAdm[$listing["admin_id"]]) ? $arrAdm[$listing["admin_id"]] : "" ?></b></br>
							<b>Ghi chú đơn hàng: <?=$listing["ord_note_customer"]?></b>
						</td>
						<td>
							<div>Trạng thái: <?=isset($arrayStatus[$listing['ord_status']]) ? $arrayStatus[$listing['ord_status']] : "" ?></div>
							<select onchange="active_package(<?=$listing['ord_id']?>,this.value)" class="form-control">
								<option value="1"  <?=$listing['ord_status']==1 ? 'selected' : '' ?>>Chưa thanh toán</option>
								<option value="2"  <?=$listing['ord_status']==2 ? 'selected' : '' ?>>Đã thanh toán</option>
								<option value="3"  <?=$listing['ord_status']==3 ? 'selected' : '' ?>>Hủy</option>
							</select>
							<a style="display: block; margin-top: 10px;" title="<?=translate_text("Add note")?>" class="thickbox noborder" href="detail.php?ord_id=<?=$listing['ord_id']?>&TB_iframe=true&amp;height=450&amp;width=650" style="color:#0000FF; font-family:Tahoma; font-size:11px"><?=translate_text("Chi tiết đơn hàng")?></a>
						</td>
						<td>
						<table>
							<tr>
								<td><textarea style="width: 200px;" id="box_note_<?=$listing["ord_id"]?>"><?=$listing["ord_note"]?></textarea></td>
							</tr>
							<tr>
								<td><button onclick="add_note(<?=$listing["ord_id"]?>);">Lưu</button></td>
							</tr>
						</table>
						</td>
					</tr>
				<? } ?>
			</table>
		</div>
	</div>
</div>

<table width="100%" cellpadding="2" cellspacing="2">
	<tr>
		<td><span class="page">Total Record: </span><span class="page_current"><?=formatCurrency($total_record)?></span></td>
		<? if($total_record > $page_size){ ?>
			<td><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type, 0, 15)?></td>
		<? } ?>
		<td align="right"><a title="Go to top" accesskey="T" class="page" href="#">Lên trên<img align="absmiddle" border="0" hspace="5" src="../../resource/images/top.png"></td>
	</tr>
</table>

<? /*---------Body------------*/ ?>
</body>
</html>
<? unset($db_listing); ?>
<script type="text/javascript">
function add_note(id) {
	var str_text = $("#box_note_"+id).val();
	$.ajax({
		type: 'POST',
		url: 'add_note.php',
		data: {recordId: id, text : str_text},
		success: function(data){
			alert("Cập nhật thành công");
			window.location.reload();
		},
		dataType: 'json'
	});
}

function uso_cancel(id){
	if(id){
		$.post("delete.php", {
			"record_id": id
		}, function(json){
			if(json.status == 1){
				alert(json.msg);
				$("tr#tr_"+id).hide();
			}else{
				alert(json.msg);
			}
		}, 'json');
	}
}

function active_package(id,value) {
	$.ajax({
		type: 'POST',
		url: 'active.php',
		data: {recordId: id, value : value},
		success: function(data){
			alert("Cập nhật thành công");
			window.location.reload();
		},
		dataType: 'json'
	});
}

</script>

<style type="text/css">
	.page{
		padding: 2px;
		font-weight: bold;
		color: #333333;
	}
	.page_current{
		padding: 2px;
		font-weight: bold;
		color: red;
	}
</style>