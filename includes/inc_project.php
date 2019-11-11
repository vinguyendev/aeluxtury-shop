<div class="banner_project">
	<div class="banner-content">
		<div class="wrap_content">
			<h2>Dự án thiết kế thương hiệu <br>Design95 đã thực hiện</h2>
			<div class="desc">
		        Với kinh nghiệm hơn <?=$con_count_exp?>+ năm hoạt động, cung cấp dịch vụ cho hơn <br>
		        <strong><?=$con_count_customer?>+</strong> khách hàng, Design95 hân hạnh giới thiệu các dự án tiêu biểu<br>
		         do chúng tôi thực hiện dưới đây.
	      </div>
		</div>
	</div>
</div>
<?
	$keyword = getValue('keyword', "str", "GET", "");
	$dv      = getValue('dv', "int", "GET", 0);
	$sql = "";
	if($keyword != ""){
		$sql .= " AND prj_title LIKE  '%" . $keyword . "%' ";
	}
	if($dv != 0){
		$sql .= " AND prj_dichvu_id = " . $dv . " ";
	}

?>
<div class="project-menu">
	<div class="wrap_content">
		<ul class="search-menu-top">
          <li class="search-form">
            <form method="get">
              <button type="button" class="btn-search" id="btn-search"><i class="fas fa-search"></i></button>
              <input type="text" class="search-text" name="keyword" id="keyword" value="<?=$keyword?>" placeholder="Tìm kiếm...">
            </form>
          </li>
          <li class="loaisanpham ">
            <a href="javascript:void(0);" class="toggle-on-mobile"><span class="hidden-mobile">Theo loại</span> sản phẩm <span class="caret"></span></a>
            <div class="wrap_content mega-full">
              	<ul class="subrow">
              		<li>
                       <a class="item" href="/du-an.html">Tất cả</a> 
                    </li>
              		<?
              		$db_dv = new db_query("SELECT * FROM properties WHERE ppe_active = 1 AND ppe_type = 1  ORDER BY ppe_id ASC");
              		while ($row = mysqli_fetch_assoc($db_dv->result)) {
              			?>
						<li>
	                       <a class="item" href="/du-an.html?dv=<?=$row['ppe_id']?>"><?=$row['ppe_name']?></a> 
	                    </li>
              			<?
              		}
              		unset($db_dv);
              		?>
                  <div class="clearfix"></div>
               </ul>
            </div>
          </li>
    <!--       <li class="sapxep">
            <a href="javascript:void(0);" class="toggle-on-mobile">Sắp xếp <span class="caret"></span>
            </a>
            <ul class="sub-menu">
              <li><a href="https://www.saokim.com.vn/project/">Dự án tiêu biểu</a></li>
              <li><a href="https://www.saokim.com.vn/project/?sort_by=moinhat">Dự án mới đăng</a></li>
              <li><a href="https://www.saokim.com.vn/project/?sort_by=xemnhieu">Dự án xem  nhiều</a></li>
            </ul>
          </li> -->
    	</ul>
	</div>
</div>
<div class="project-list">
	<div class="wrap_content">
		<?
		$db_pro = new db_query("SELECT * FROM project WHERE prj_active = 1 " . $sql . " ORDER BY prj_id DESC LIMIT 18");
		$count = mysqli_num_rows($db_pro->result);
		while ($row = mysqli_fetch_assoc($db_pro->result)) {
			$link = createlink("project", array('nTitle' => $row['prj_title'], "iData" => $row['prj_id']));
			$img = getUrlImageProject($row['prj_logo'], "medium");
			?>
			<div class="item">
			    <div class="item-img">
			        <img src="<?=$img?>" class="lazy initial loaded" data-original="<?=$img?>" width="100%" alt="<?=$row['prj_title']?>" data-was-processed="true">
			        <a class="item-bg" style="background-color:#e94528;"></a>
			        <a class="item-content" href="<?=$link?>" target="_blank">
			            <div class="item-content-inner">
			                <h3><?=$row['prj_title']?></h3>
			                <h4><?=$row['prj_description']?></h4>
			                <span class="more">View</span>
			            </div>
			        </a>
			        <!-- <div class="hits">6086</div> -->
			    </div>
			</div>
			<?
		}
		unset($db_pro);
		?>
	</div>
	<?
	if($count >= 18){
		?>
		<center><a data-dv="<?=$dv?>" data-page="1" onclick="show_pro();" class="btn btn_more">Xem thêm dự án</a></center>
		<?
	}
	?>
	
</div>
<div class="home-testimonial">
	<div class="wrap_content">
		<div class="title">
			<div class="sow-headline-container ">
				<h1 class="sow-headline">KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI</h1>
				<div class="decoration"><div class="decoration-inside"></div></div>
			</div>
		</div>
		<div id="owl-demo2" class="owl-carousel">
			<?
			$db_feed = new db_query("SELECT * FROM feedback WHERE fed_active = 1 ORDER BY feb_id DESC LIMIT 5");
			while ($row = mysqli_fetch_assoc($db_feed->result)) {
				$img = getUrlImageFeedback($row['fed_logo'], "medium");
				?>
				<div class="item">
	            	<div class="item-content">
	            		<div class="item-rating">
	            			<?
	            			$star = intval( $row['fed_star']);
	            			if($star > 5){
	            				$star = 5;
	            			}
	            			for ($i=1; $i <= $star ; $i++) { 
	            				echo '<i class="fas fa-star"></i>';
	            			}
	            			?>
	            		</div>
	            		<div class="item-text">
	                		<?=$row['fed_content']?>
	                	</div>
	                </div>
	            	<div class="item-client-info">
	            		<div class="item-client-img"> 
	            			<img src="<?=$img?>" class="img-responsive lazy loaded" data-original="<?=$img?>" alt="Chị Lan" data-was-processed="true">
	            		</div>
	            		<h3><?=$row['fed_name']?></h3>
	            		<div class="item-client-position"><?=$row['fed_pos']?><br><?=$row['fed_company']?></div>
	            	</div>
	            </div>
				<?
			}
			unset($db_feed);
			?>
          </div>
	</div>
</div>
<div class="submit_pro">
	<div class="wrap_content">
		<div class="wrap_submit_pro">
			<div class="bottom-txt">Sẵn sàng khởi tạo dự án của bạn?</div>
			<div class="bottom-btn" ><a href="/lien-he.html" class="btn btn-default hvr-hang" data-toggle="modal" data-target="#callback"> BẮT ĐẦU NGAY !</a></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	function show_pro() {
		var dv = $( ".btn_more" ).attr( "data-dv" );
		var page = $( ".btn_more" ).attr( "data-page" );
		$.ajax({
            url: '/ajax/load_more_prj.php',
            type: "POST",
            data: {page: page, dv: dv},
            dataType: 'html',
            success: function (result) {
                
                $(".btn_more").attr('data-page', ++page);
                if (result != '') {
                    $('.project-list .wrap_content').append(result);
                } else {
                    $('.project-list ').append('<span class="no_more" style="width:100%; clear:both;display: block;text-align: center;padding-top: 20px;">Dữ liệu đã hết. Xin vui lòng quay lại sau!</span>');
                    $('.btn_more').hide();
                }
            },
            beforeSend: function () {
                // $('.btn_view_more_home img').show();
            }
        });
	}
</script>