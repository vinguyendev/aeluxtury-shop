<div class="wrap_content head_prj">
	<h1><?=$news_info['prj_title']?> </h1>
	<h2><?=$news_info['prj_description']?></h2>
</div>
<div class="detail_prj">
	<div class="wrap_content" >
		<div class="left">
			<?=$news_info['prj_content']?>
		</div>
		<div class="right">
			<div class="heading-title">
				Khách hàng
			</div>
			<p style="padding: 5px 0 10px 0;">&#8226; <?=$news_info['prj_customer']?></p>
			<div class="heading-title">
				Khu vực
			</div>
			<p style="padding: 5px 0 10px 0;">&#8226; <?=$news_info['prj_location']?></p>
			<div class="heading-title">
				Lĩnh vực
			</div>
			<p style="padding: 5px 0 10px 0;">&#8226; <?=$arr_lv[$news_info['prj_linhvuc_id']]?></p>
			<div class="heading-title">
				Dịch vụ cung cấp
			</div>
			<p style="padding: 5px 0 10px 0;">&#8226; <?=$arr_dv[$news_info['prj_dichvu_id']]?></p>
		</div>
	 
	</div>
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