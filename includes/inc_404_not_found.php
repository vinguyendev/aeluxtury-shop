<div id="notfound">
	<div class="im_notfound">
		<img src="<?=$staticCucreServer . 'css/v6/images/not_found.jpg'?>" alt="not found cucre.vn" />
		<a class="note" href="http://cucre.vn/vn/">Quay về trang chủ cucre.vn</a></span>
	</div>
	<div class="nf_product">		
		<div>
			<p class="title">Danh mục nổi bật</p>
			<?
			$arrayCat	= array(
				1 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/686,new/thoi-trang.html',
						'name' => 'Thời trang',
						'img'  => $staticCucreServer . 'css/v6/images/cat_thoitrang.gif'
					),
				2 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/679,new/do-gia-dung.html',
						'name' => 'Đồ gia dụng',
						'img'  => $staticCucreServer . 'css/v6/images/cat_dogiadung.gif'
					),
				3 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/681,new/me-be.html',
						'name' => 'Mẹ và bé',
						'img'  => $staticCucreServer . 'css/v6/images/cat_mevabe.gif'
					),
				4 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/704,new/cong-nghe.html',
						'name' => 'Công nghệ',
						'img'  => $staticCucreServer . 'css/v6/images/cat_congnghe.gif'
					),
				5 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/678,new/dich-vu-am-thuc.html',
						'name' => 'Dịch vụ - Ẩm thực',
						'img'  => $staticCucreServer . 'css/v6/images/cat_amthuc.gif'
					),
				6 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/692,new/my-pham.html',
						'name' => 'Mỹ phẩm',
						'img'  => $staticCucreServer . 'css/v6/images/cat_mypham.gif'
					),
				7 => array(
						'link' => 'http://www.cucre.vn/vn/tp-hcm/675,new/giam-gia-khac.html',
						'name' => 'Giảm giá khác',
						'img'  => $staticCucreServer . 'css/v6/images/cat_giamgiakhac.gif'
					),
				8 => array(
						'link' => 'http://www.cucre.vn/vn/du-lich-tiet-kiem.html',
						'name' => 'Du lịch tiết kiệm',
						'img'  => $staticCucreServer . 'css/v6/images/cat_dulich.gif'
					)
			);		
			?>
			<table width="100%" cellspading="0" cellpadding="0" class="cat">
				<?
				echo '<tr>';
				$j = 1;
				foreach($arrayCat as $catInfo){
					echo '<td>
						<a href="'. $catInfo['link'] .'"><img src="'. $catInfo['img'] .'" /></a>
						<a href="'. $catInfo['link'] .'" target="_blank"><i class="icon"></i>'. $catInfo['name'] .'</a>
					</td>';
					if($j % 4 == 0){
						echo '</tr><tr>';
					}
					$j++;
				}
				echo '</tr>';
				?>
			</table>
		</div>
	</div>
	<p class="title_view">Xem thêm sản phẩm bán chạy nhất</p>
	<div class="prod" style="	margin: 0; padding: 0;width: 100%;">
		<?
		$listid	= '';//11856,18526,12928,19567,19010,13249,14542';
		if(!$memcached_store) $memcached_store	= new memcached_store();
		$listid	= $memcached_store->get('BestSell_' . $iCit);
		if($listid == ''){
			$listid	= '12525,20219,16309,9922,9144';
		}else{
			$listid	= convert_array_to_list($listid);
		}
		$arrayDeal = getInfoListDeal($listid);
		?>
		<table>
			<tr>
			<?if(count($arrayDeal) > 0){
				$i = 0;
				foreach($arrayDeal as $key => $value){
					if($i > 4) break;
					$link	= createlinkDealDetail(5, 'ha nội', $value["pha_category_id"], $value["cat_name"], $value["pha_id"], $value["pha_short_name"]);
					$ppe_percent 	= ($value["ppe_percent"] > 0) ? $value["ppe_percent"] : round((($value["pha_price"] - $value["ppe_price"])/$value["pha_price"])*100);
					?>						
					<td>
						<div class="phaDeal">
							<p style="text-align: center;"><a href="<?=$link?>"><img src="<?=$images_path . 'pictures/phagia/222x222/' . $value['pha_picture']?>" alt="<?=$value['pha_short_name']?>" /></a></p>
							<p><a class="pron" href="<?=$link?>"><?=$value['pha_short_name']?></a></p>
							<p><b class="new"><?=$value['ppe_price'] . 'đ'?></b> <b class="old"><?=$value['pha_price'] . 'đ'?></b></p>
							<span class="dmon"><?=$ppe_percent .'%'?></span>
						</div>
					</td>
				<?
					$i++;
				}
			}
			?>
			</tr>
		</table>
	</div>
</div>