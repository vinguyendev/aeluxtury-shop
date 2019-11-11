<?
$name    = getValue("name", "str", "POST", "");
$phone   = getValue("phone", "str", "POST", "");
$email   = getValue("email", "str", "POST", "");
$message = getValue("message", "str", "POST", "");
$action  = getValue("action", "str", "POST", "");
if($action == "contact"){
    $db_ex = new db_execute("INSERT INTO contact (cot_full_name,cot_email,cot_phone,cot_content,cot_create_time) VALUES 
        ('" . $name . "','" . $phone . "','" . $email . "','" . $message . "'," . time() . ")");
    echo '<script type="text/javascript">
    alert("Cảm ơn bạn đã gửi liên hệ! Chúng tôi sẽ gọi lại sớm nhất cho bạn!");
    window.location.href = "/";
</script>';
}
?>
<?

if($catParent != ""){
	// check hien thi
	$check_view = "";
	if(isset($_COOKIE['data-view'])) {
		$check_view = $_COOKIE['data-view'];
	}else{
		$check_view = 1;
	}
	
	$sqlOrderBy	= "";
	// Phân trang
	require_once("../functions/pagebreak.php");
	$normal_class        = "";
	$selected_class      = "active";
	$page_prefix         = "";
	$previous            = "Trước";
	$next                = "Sau";
	$first               = "Trang đầu";
	$last                = "Trang cuối";
	$break_type          = 1;
	$url                 = createlink("category", array("iCat" => $iCat, "nTitle" => $nCat));
	$page_size           = 12;

	$sqlWhere            = "";

	$current_page        = getValue("page", "int", "GET", 1);

	$arrayCountProduct   = getListProduct($iCat, 0, 0, $sqlWhere);
	$count               = count($arrayCountProduct);

	if($count % $page_size	== 0){
		$num_of_page	= $count / $page_size;
	}else{
		$num_of_page	= (int)($count / $page_size) + 1;
	}

	if($current_page > $num_of_page) $current_page	= $num_of_page;

	if($current_page < 1) $current_page	= 1;
	
	$arrayListProduct		= getListProduct($iCat, ($current_page - 1 ) * $page_size, $page_size, $sqlWhere, $sqlOrderBy);
	?>
	<div class="list_product">
        <div class="container">
            <div class="filter-head">
                <div class="main-about-text">
                	<br/>
                    <h2 class="h1 gold">Danh sách sản phẩm</h2>
                    <h3 class="white h3"><?=$infoCategory['cat_name']?></h3></div>
                <div class="clearfix"></div>
            </div>
        </div>
<!--         <div class="page-filters portfolio-filters"><a href="#" class="sidebar-close filter-close visible-xs">×</a>
		    <div class="container">
		        <div class="filters">
		            <form name="_form" id="portfolio_flt" action="/en/portfolio/" method="post">
		                <div class="row">
		                    <div class="col-md-9 col-sm-9 col-xs-8">
		                        <div class="inner-wrap">
		                            <div class="checkbox-row">
		                                <label>
		                                    <input onclick="smartFilter.click(this)" name="arrFilter_93_1662243607" id="arrFilter_93_1662243607" value="Y" type="checkbox" class="ng-not-empty"><span></span> Commercial interiors </label>
		                                <label>
		                                    <input onclick="smartFilter.click(this)" name="arrFilter_93_336913281" id="arrFilter_93_336913281" value="Y" type="checkbox" class="ng-not-empty"><span></span> Residential interiors </label>
		                                <label>
		                                    <input onclick="smartFilter.click(this)" name="arrFilter_93_2225864208" id="arrFilter_93_2225864208" value="Y" type="checkbox" class="ng-not-empty"><span></span> Architectural design </label>
		                            </div>
		                            
		                        </div>
		                    </div>
		                    <div class="col-md-3 col-sm-3 col-xs-4">
		                        <div class="reset-link-wrap"><a onclick="smartFilter.delFilter()" class="reset-link">Reset</a></div>
		                    </div>
		                </div>
		            </form>
		        </div>
		    </div>
		</div> -->
		<div class="mobile-filter-toggle insta-icon visible-xs">
			<span class="slides <?=$check_view==2 ? ' active' : "" ?>" onclick="filterLayout(this)" data-view="2"></span> 
			<span class="tile <?=$check_view==1 ? ' active' : "" ?>" onclick="filterLayout(this)" data-view="1"></span> 
			<!-- <a href="#" title="">
				<span></span>
			</a> -->
		</div>
        <br/>
		    <div class="container portfolio_list" id="portfolio-list" <?=$check_view==2 ? ' style="display: none;"' : "" ?>>
		        <div class="portfolio-list">
		            <div class="row  insta tile" >
		            	<?
		            	$i = 0;
		            	foreach ($arrayListProduct as $key => $value) {
						
						$pro_url         	= createlink('product_detail', array("nTitle"=> $value['pro_name'], "iData" =>$value['pro_id'] ));
						$picture_product 	= getUrlImageProduct($value['pro_picture'], "medium");
						if($i % 2 == 0){
							echo '<div class="clearfix ng-scope"></div>';
						}
						?>

						<div class="col-sm-6 portf-col ng-scope">
							<div class="m2"><?=format_number($value['pro_mil'])?> м<sup>2</sup></div>
		                    <a href="<?=$pro_url?>"  title="<?=$value['pro_name']?>">
		                        <div class="portfolio-item-img"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=$picture_product?>" alt="<?=$value['pro_name']?>" class="lazyload" /> </div>
		                        <div class="portfolio-item-info ">
		                            <div class="portfolio-item-title"><span class="merriw"><?=$value['pro_name']?></span></div>
		                            
		                            <div class="portfolio-item-params">
		                                <div class="portfolio-item-square"><?=format_number($value['pro_mil'])?> м<sup>2</sup></div>
		                                <div class="portfolio-item-style"><?=$value['cat_name']?></div>
		                            </div>
		                        </div>
		                    </a>
		                    <br/>
		                </div>
						<?
						$i++;
						}
		            	?>
		            </div>
		        </div>
		    </div>

        <div class="container portfolio_list" id="portfolio-list2" <?=$check_view==1 ? ' style="display: none;"' : "" ?>>
            <div class="row " >
            	<?
            	foreach ($arrayListProduct as $key => $value) {
						
						$pro_url         	= createlink('product_detail', array("nTitle"=> $value['pro_name'], "iData" =>$value['pro_id'] ));
						$picture_product 	= getUrlImageProduct($value['pro_picture'], "medium");
						?>
						<div class="col-sm-4 portf-col ng-scope">
							<div class="m2"><?=format_number($value['pro_mil'])?> м<sup>2</sup></div>
		                    <a href="<?=$pro_url?>"  title="<?=$value['pro_name']?>">
		                        <div class="portfolio-item-img"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=$picture_product?>" alt="<?=$value['pro_name']?>" class="lazyload" /> </div>
		                        <div class="portfolio-item-info ">
		                            <div class="portfolio-item-title"><span class="merriw"><?=$value['pro_name']?></span></div>
		                            
		                            <div class="portfolio-item-params">
		                                <div class="portfolio-item-square"><?=format_number($value['pro_mil'])?> м<sup>2</sup></div>
		                                <div class="portfolio-item-style"><?=$value['cat_name']?></div>
		                            </div>
		                        </div>
		                    </a>
		                    <br/>
		                </div>
						<?
				}
            	?>
               
                <div class="clearfix ng-scope"></div>
                
            </div>
        </div>
        <br/>
                <div>
                	<?
                		if($current_page >= 2){
                			?>
							<a class="readmore-link button" style="float: left;" href="<?=createlink("product_cat", array("nTitle" => $infoCategory["cat_name"],"iData" => $infoCategory["cat_id"],"nParent" => 'Dự án'))?>,page-<?= $current_page - 1?>"><- Trang trước</a>
                			<?
                		}
						if($num_of_page > 1 && $num_of_page > $current_page){
							?>
                   			<a class="readmore-link button" style="float: right;" href="<?=createlink("product_cat", array("nTitle" => $infoCategory["cat_name"],"iData" => $infoCategory["cat_id"],"nParent" => 'Dự án'))?>,page-<?= $current_page + 1?>">Trang tiếp<span class="arr"></span></a>
						<? } ?>
                </div>
                <br/>
    </div>
    <div class="form-wrap margin-top-50 margin-bottom-150">
        <form name="callback" class="page-bottom-form" method="post">
            <div class="text-spec-block">
                <h2 class="gold h1">Để lại liên hệ</h2>
                <h3 class="h3 white">Chúng tôi sẽ gọi lại sớm cho bạn</h3></div>
            <div class="form-fields">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="name"                             type="text"                             id="page-35"                            required /><label class="input__label input__label--madoka" for="page-35"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Tên</span></label>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="phone"                            id="page-36"                            type="text"                    required /><label class="input__label input__label--madoka" for="page-36"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Số điện thoại</span></label>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="contact">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-submit">
                                <button type="submit" class="readmore-link">Gửi<span class="arr"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            <div class="clearfix"></div>
        </form>
    </div>
	<?
}else{

?>
<div class="inner-page-content">
    <div class="main-design-types cat_mobile">
        <div class="container">
            <div class="row">
            	<?
                $cat_db = new db_query("SELECT * FROM categories_multi WHERE cat_type =  'product' AND cat_parent_id != 0 AND cat_active = 1 ORDER BY cat_order ASC");
                while ($row = mysqli_fetch_assoc($cat_db->result)) {
                    $link = createlink("product_cat", array('nTitle' => $row['cat_name'], "iData" => $row['cat_id'], 'nParent' => $infoCategory['cat_name']));
                    $img  = LANG_PATH.'data/category/'.$row['cat_picture'];
                    ?>
                        <div class="col-sm-4">
		                    <a class="main-design-item" style="background-image: url('<?=$img?>')" href="<?=$link?>">
		                        <div class="title merriw"> <?=$row['cat_name']?> </div>
		                    </a>
		                </div>
                    <?
                }
                unset($cat_db);
                ?>
                <br> </div>
                
	            <div class="form-wrap margin-top-50">
	                <form name="callback" class="page-bottom-form" method="post">
	                    <div class="text-spec-block">
	                        <h2 class="gold h1">Để lại liên hệ</h2>
	                        <h3 class="h3 white">Chúng tôi sẽ gọi lại sớm cho bạn</h3></div>
	                    <div class="form-fields">
	                        <div class="row">
	                            <div class="col-sm-4">
	                                <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="name"                             type="text"                             id="page-35"                            required /><label class="input__label input__label--madoka" for="page-35"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Tên</span></label>
	                                    </span>
	                                </div>
	                            </div>
	                            <div class="col-sm-4">
	                                <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="phone"                            id="page-36"                            type="text"                    required /><label class="input__label input__label--madoka" for="page-36"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Số điện thoại</span></label>
	                                    </span>
	                                </div>
	                            </div>
	                            <input type="hidden" name="action" value="contact">
	                            <div class="col-sm-4">
	                                <div class="form-group">
	                                    <div class="form-submit">
	                                        <button type="submit" class="readmore-link">Gửi<span class="arr"></span></button>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                     </div>
	                    <div class="clearfix"></div>
	                </form>
	            </div>
        </div>
    </div>
</div>
<? 
}
?>
<script type="text/javascript">
	function setCookie(cname, cvalue, exdays) {
	  var d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  var expires = "expires="+ d.toUTCString();
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	function filterLayout(e) {
		$(".insta-icon span").removeClass("active");
		$(e).addClass("active");
		var data = $(e).attr( "data-view" );
		$(".portfolio_list").hide();
		if(data == '1'){
			$("#portfolio-list").show();
		}else if(data == '2'){
			$("#portfolio-list2").show();
		}
		setCookie("data-view",data,3600);
	}
</script>