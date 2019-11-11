<?
require_once("../../resource/security/security.php");

$module_id = 11;
$fs_fieldupload  = "ab_img1";
$fs_fieldupload2 = "ab_img2";
$fs_fieldupload3 = "ab_img3";

$fs_filepath			= "../../../data/background/";
$fs_extension			= "gif,jpg,jpe,jpeg,png";
$fs_filesize			= 4000;
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table				= "about";
$id_field				= "ab_id";

//Cấu hình static
$arrStatic	= array ("Liên hệ"					=> "con_static_contact",
					"Cuối trang"				=> "con_static_footer",
					"Đăng nhập để đặt hàng"	=> "con_static_paymentlogin",
					"Thông báo ở phần toolbar dưới"	=> "con_static_intro",
					"Hướng dẫn sử dụng"		=> "con_static_huongdansudung",
					"Yêu cầu dịch vụ"			=> "con_static_yeucaudichvu",
					);
?>