<div class="footer-push"></div>
<footer class="footer">
    <div class="container-footer">
        <div class="bottom-menus">
            <div class="row">
                <div class="col-md-4  ">
                    <ul class="footer-menu gold-menu ">
                        <li><a href="/" class="">Trang chủ</a></li>
                        <li><a href="/gioi-thieu.html" class=" ">Về chúng tôi</a></li>
                        <li><a href="/lien-he.html" class="">Liên hệ</a></li>
                    </ul>
                </div>
                
            	<?
				$url_current = $_SERVER['REQUEST_URI'];
				$i = 0;
				$db_query = new db_query("SELECT * FROM menus WHERE mnu_type = 1 AND mnu_active = 1 AND mnu_parent_id = 0 ORDER BY mnu_order ASC");
				while ($row = mysqli_fetch_assoc($db_query->result)) {
					$classChild = "";
					$classHome = "";
					$classActive = "";

					// if($url_current == $row['mnu_link']){
					// 	$classActive = " active";
					// }
					echo '<div class="col-md-4 "><ul class="footer-menu mixed-menu ">';
					echo '<li><a href="' . $row['mnu_link'] . '" target="' . $row['mnu_target'] . '" class="">' . $row['mnu_name'] . '</a>';
					// echo '<li><a class="' . $classActive . '" href="' . $row['mnu_link'] . '" target="' . $row['mnu_target'] . '">' . $row['mnu_name'] . '</a><span class="sub-toggle"></span>';
					$db_sub = new db_query("SELECT * FROM menus WHERE  mnu_type = 1 AND mnu_active = 1 AND mnu_parent_id = " . $row['mnu_id'] . " ORDER BY mnu_order ASC ");
					if(mysqli_num_rows($db_sub->result) > 0){
						echo '<ul class="footer-sub-menu" style="display:block;">';
						while ($row_sub = mysqli_fetch_assoc($db_sub->result)) {
							echo '<li><a target="' . $row_sub['mnu_target'] . '" href="' . $row_sub['mnu_link'] . '">' . $row_sub['mnu_name'] . '</a></li>';
						}
						echo '</ul>';
					}
					unset($db_sub);

					echo '</li>';
					$i++;
					echo '</ul>
                </div>';
				}
				unset($db_query);
				?>
                               
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-12 phones">
                	<?=$con_footer?>
                </div>
            </div>
        </div>
        <div class="footer-bottom-copy">
            <div class="footer-socials"><a href="<?=$con_link_fb?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            	<a href="<?=$con_link_insta?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            	<a href="<?=$con_link_twiter?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></div>
            <div class="copyright"> &copy;&nbsp; 2016 Aeluxury
                <br /> Sáng Tạo - Tinh Tế - Đẳng Cấp</div>
        </div>
    </div>
</footer>
</div>
<div class="wrapper-scroll-btn"><span><span class="scrollup-btn" id="scrollup-btn">up</span></span>
</div>
<div class="wrapper-scroll-btn wrapper-scroll-sb"><span><span class="scrollup-btn" id="scrollup-sb">up</span></span>
</div>
<script type="text/javascript" src="<?=STATIC_PATH?>js/template_623af5ea678b2f76539ca06f43e400847a65.js"></script>
<script src="<?=STATIC_PATH?>js/ls.bgset.min.js" async=""></script>
<script src="<?=STATIC_PATH?>js/lazysizes.min.js" async=""></script>
<script type="text/javascript" language="javascript" src="<?=STATIC_PATH?>js/owl.carousel.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

      $("#owl-demo").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
        autoPlay : true,
      });


    });
</script>
