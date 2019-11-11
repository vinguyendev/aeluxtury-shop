<div class="banner_about">
	<!-- <img src="images/about-us.jpg"> -->
	<?
	$arrBanner = getBanner(6, 0, 1, 0, 5);
	if(count($arrBanner) > 0){
		foreach ($arrBanner as $key => $value) {
			echo '<a href="' . $value['ban_link'] . '" target="_blank"><img src="' . LANG_PATH.'data/banner/'. $value["ban_picture"] . '"></a>';
		}
	}
	?>
</div>
<div class="wrap_sevice">
	<div class="wrap_content">
		<!-- <div class="sow-headline-container ">
			<h1 class="sow-headline">Dịch vụ được quan tâm nhất</h1>
			<div class="decoration">
				<div class="decoration-inside"></div>
			</div>
		</div> -->
		<div class="spec_sevice">
			<?
			$db_query = new db_query("SELECT * FROM sevice WHERE sev_active = 1 AND sev_hot = 1 ORDER BY sev_id ASC");
			while ($row = mysqli_fetch_assoc($db_query->result)) {
				$link = createlink("sevice", array('nTitle' => $row['sev_title'], "iData" => $row['sev_id']));
				$img   = getUrlImageNews($row['sev_image'],"");
				?>	
				<div class="item_spec">
					<a href="<?=$link?>">
						<div class="item-img">
							<img class="solution-icon initial loading" src="<?=$img?>" alt="<?=$row['sev_title']?>" data-was-processed="true">
						</div>
						<h3><?=$row['sev_title']?></h3>	
					</a>
				</div>
				<?
			}
			unset($db_query);
			?>
			
			
		</div>
		<div class="sow-headline-container ">
			<h1 class="sow-headline">Danh mục dịch vụ chi tiết</h1>
			<div class="decoration">
				<div class="decoration-inside"></div>
			</div>
		</div>
		<div class="content_sevice">
			<?
			$db_sevice = new db_query("SELECT * FROM sevice WHERE sev_active = 1 AND sev_parent_id = 0 ORDER BY sev_id ASC");
			while ($row = mysqli_fetch_assoc($db_sevice->result)) {
				$link = createlink("sevice", array('nTitle' => $row['sev_title'], "iData" => $row['sev_id']));
				?>
					<div>
						<h3>
							<a href="<?=$link?>"><strong><?=$row['sev_title']?></strong></a>
						</h3>
						<ul>
							<?
							$db_sevice2 = new db_query("SELECT * FROM sevice WHERE sev_active = 1 AND sev_parent_id = " . $row['sev_id'] . " ORDER BY sev_id ASC");
							while ($row2 = mysqli_fetch_assoc($db_sevice2->result)) {
								$link2 = createlink("sevice", array('nTitle' => $row2['sev_title'], "iData" => $row2['sev_id']));
								echo '<li><a href="' . $link2 . '">' . $row2['sev_title'] . '</a></li>';
							}
							?>
						</ul>
					</div>
				<?
			}
			unset($db_sevice);
			?>
			
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