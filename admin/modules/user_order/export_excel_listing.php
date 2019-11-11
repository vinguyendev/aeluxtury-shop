<?
require_once("inc_security.php");
require_once("../../../config/inc_excel_config.php");

$objPHPExcel	= new PHPExcel();
$sheet			= $objPHPExcel->getActiveSheet();

$objPHPExcel->getProperties()	->setCreator('Admin')
										->setLastModifiedBy('Admin')
										->setKeywords('Excel php Schedule')
										->setDescription('Dữ liệu được export từ CSDL');

$sheet->getColumnDimension('A')->setWidth(25);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(20);
$sheet->getColumnDimension('J')->setWidth(20);
$sheet->getColumnDimension('K')->setWidth(25);
$sheet->getColumnDimension('L')->setWidth(20);

// Tiêu đề
$sheet->mergeCells('A1:L1')->setCellValue('A1', iconv('UTF-8','UTF-8', "Danh sách gói học đã mua."));
$sheet->getRowDimension(1)->setRowHeight(30);
$sheet->getStyle('A1:L1')->applyFromArray($con_excel_style_title);

$sheet->getRowDimension(2)->setRowHeight(20);
$sheet->getStyle('A2:N2')->applyFromArray($con_excel_style_columnTitle);
$sheet->setCellValue('A2', 'User name')
		->setCellValue('B2', 'Phone')
		->setCellValue('C2', 'Email')
		->setCellValue('D2', 'Package Name')
		->setCellValue('E2', 'Price')
		->setCellValue('F2', 'Quantity')
		->setCellValue('G2', 'Status')
		->setCellValue('H2', 'Quantity Avaiable')
		->setCellValue('I2', 'Time start')
		->setCellValue('J2', 'Time exprice')
		->setCellValue('K2', 'Payment method')
		->setCellValue('L2', 'Date buy');;


$db_listing	= new db_query("  SELECT *
         							FROM " . $fs_table . "
         							STRAIGHT_JOIN learning_package ON (lep_id = uso_package_id)
         							STRAIGHT_JOIN users ON (use_id = uso_user_id)
         							WHERE 1 " . $sqlWhere . "
         							ORDER BY " . $sqlOrderBy);
$i = 3;
while($listing = mysql_fetch_assoc($db_listing->result)){
	$text_status 	= "";
	switch ($listing['uso_status']) {
		case 0:
			$text_status 	= "Cancel";
			break;
		case 1:
			$text_status 	= "Active";
			break;
		default:
			$text_status 	= "Pendding";
			break;
	}
	$quantity_avaiable 	= "";
	$time_start 			= "";
	$time_exprire 			= "";
	if($listing['uso_status'] == 1){
		$quantity_avaiable 	= $listing['uso_session_avaiable'];
		$time_start 	= date("d/m/Y", $listing['uso_date_active']);
		$time_exprire 	= date("d/m/Y", $listing['uso_date_expire']);
	}
	$payment_method 	 = isset($array_method_pay[$listing['uso_method_pay']]) ? $array_method_pay[$listing['uso_method_pay']] : "";

  	$sheet->getRowDimension($i)->setRowHeight(20);
  	$sheet->getStyle('A' . $i)->applyFromArray($con_excel_style_left);
	$sheet->getStyle('B' . $i)->applyFromArray($con_excel_style_left);
	$sheet->getStyle('C' . $i)->applyFromArray($con_excel_style_left);
	$sheet->getStyle('D' . $i)->applyFromArray($con_excel_style_left);
	$sheet->getStyle('E' . $i)->applyFromArray($con_excel_style_right);
	$sheet->getStyle('F' . $i)->applyFromArray($con_excel_style_right);
	$sheet->getStyle('G' . $i)->applyFromArray($con_excel_style_left);
	$sheet->getStyle('H' . $i)->applyFromArray($con_excel_style_right);
	$sheet->getStyle('I' . $i)->applyFromArray($con_excel_style_center);
	$sheet->getStyle('J' . $i)->applyFromArray($con_excel_style_center);
	$sheet->getStyle('K' . $i)->applyFromArray($con_excel_style_center);
	$sheet->getStyle('L' . $i)->applyFromArray($con_excel_style_center);

	$sheet->setCellValue('A' . $i, $listing['use_name'])
			->setCellValue('B' . $i, $listing['use_phone'])
			->setCellValue('C' . $i, $listing['use_email'])
			->setCellValue('D' . $i, $listing['lep_name'])
			->setCellValue('E' . $i, formatCurrency($listing['lep_prices']))
			->setCellValue('F' . $i, $listing['lep_session'])
			->setCellValue('G' . $i, $text_status)
			->setCellValue('H' . $i, $quantity_avaiable)
			->setCellValue('I' . $i, $time_start)
			->setCellValue('J' . $i, $time_exprire)
			->setCellValue('K' . $i, $payment_method)
			->setCellValue('L' . $i, date("d/m/Y", $listing["uso_create_time"]));
  $i++;
}
unset($db_listing);

$objPHPExcel->getActiveSheet()->setTitle("Danh sách gói học đã mua");
$objPHPExcel->setActiveSheetIndex(0);

// Xuất ra file excel
$export_filename = "Gói học đã mua " . date("Ymd") . "_" . time() . ".xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $export_filename . '"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
