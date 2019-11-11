<?
include ("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
$record_id	= getValue("record_id", "int", "POST", 0);
$type			= getValue("type", "str", "POST", "", 1);

$sql			= "";
$msg			= "";
$data			= "";
$json			= array();

//kiem tra xem co ban ghi nay kong
$db_check	= new db_query("	SELECT * FROM " . $fs_table . "
										WHERE pro_id = " . $record_id
									);
if($row	= mysqli_fetch_assoc($db_check->result)){
	//Kiểm tra field
	switch($type){
		case 'action_active':
			$value	= abs(1 - $row['pro_active']);
			$sql		= " pro_active = " . abs(1 - $row['pro_active']);
			break;
		case 'action_new':
			$value	= abs(1 - $row['pro_new']);
			$sql		= " pro_new = " . abs(1 - $row['pro_new']);
			break;
		case 'action_hot':
			$value	= abs(1 - $row['pro_hot']);
			$sql	= " pro_hot = " . abs(1 - $row['pro_hot']);
			break;
		case 'action_reserve':
			$value 	= abs(1 - $row['pro_reserve']);
			$sql = " pro_reserve = " . $value;
			break;
	}

	if($sql != "" && isset($value) && ($value == 1 || $value == 0)){
		// Cập nhật dữ liệu
		$db_update	= new db_execute("UPDATE " . $fs_table . " SET " . $sql . " WHERE pro_id = " . $record_id);
		if($db_update->msgbox > 0){
			$data	= '<img border="0" src="../../resource/images/grid/check_' . $value . '.gif" />';
		}else{
			$msg	= "Xảy ra lỗi khi cập nhật";
		}
	}else{
		$msg	= "Không tồn tại type active";
	}
}else{
	$msg	= "Không tồn tại bản ghi này";
}

$json['msg']	= $msg;
$json['data']	= $data;
unset($db_check);
echo json_encode($json);
?>