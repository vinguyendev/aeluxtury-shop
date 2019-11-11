<div id="panel"></div>
    <div class="page-loader-main">
        <div class="loader-section"></div>
        <div class="loader-section"></div>
        <div class="loader-section"></div>
        <div class="loader-section"></div>
        <div class="loader-section"></div>
        <div class="loader-section"></div>
    </div>
    <div class="page-wrap">
        <div class="page-lines">
            <div class="page-line"></div>
            <div class="page-line"></div>
            <div class="page-line"></div>
            <div class="page-line"></div>
            <div class="page-line"></div>
        </div>
        <div class="slider-phone">
        	<a href="tel:<?=$con_hotline?>"><?=$con_hotline?></a>
        	<a href="<?=$con_link_fb?>" target="_blank">
        		<i class="fa fa-facebook" aria-hidden="true"></i>
        	</a>
        	<a href="<?=$con_link_insta?>" target="_blank">
        		<i class="fa fa-instagram" aria-hidden="true"></i>
        	</a>
        	<a href="<?=$con_link_twiter?>" target="_blank">
        		<i class="fa fa-pinterest-p" aria-hidden="true"></i>
        	</a>
            <a target="_blank" href="http://zalo.me/0965808868" class="zalo">
                &nbsp;  
            </a>
        </div>
        <div class="main-view"></div>
        <div>
            <div class="nav-toggle ">
                <a href="/" class="logo">
                    <div class="logo-images">
                        <div class="logo-img logo-white"></div>
                        <div class="logo-img logo-dark"></div>
                    </div>
                </a><a class="toggle-button" href="#"><span>Menu</span></a></div>
            <div class="ng-pageslide-overlay"></div>
            <div class="main-menu ng-isolate-scope ng-pageslide" id="mainmenu" data-ps-open="" style="width:0px">
                <div class="main-menu-wrap">
                    <div class="bottom-menus">
                        <div class="row">
                            <div class="col-md-6 ">
                                <ul class="footer-menu gold-menu ">
                                    <li><a href="/" class="">Trang chủ</a></li>
                                    <li><a href="/gioi-thieu.html" class=" ">Về chúng tôi</a></li>
                                    <li><a href="/lien-he.html" class="hidden-xs">Liên hệ</a></li>
                                </ul>
                            </div>

                            <div class="col-md-6 ">
                                <ul class="footer-menu mixed-menu ">
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
                                        $classColor = "";
                                        if($i == 0){
                                           $classColor = " style='color:#cba37c'; ";
                                        }
										echo '<li><a ' . $classColor . ' class="' . $classActive . '" href="' . $row['mnu_link'] . '" target="' . $row['mnu_target'] . '">' . $row['mnu_name'] . '</a>';
										$db_sub = new db_query("SELECT * FROM menus WHERE  mnu_type = 1 AND mnu_active = 1 AND mnu_parent_id = " . $row['mnu_id'] . " ORDER BY mnu_order ASC ");
										if($row['mnu_has_child'] == 1){
                                            echo '<span class="sub-toggle"></span>';
                                            echo '<ul class="footer-sub-menu">';
                                            if(mysqli_num_rows($db_sub->result) > 0){
    											

    											while ($row_sub = mysqli_fetch_assoc($db_sub->result)) {
    												echo '<li><a target="' . $row_sub['mnu_target'] . '" href="' . $row_sub['mnu_link'] . '">' . $row_sub['mnu_name'] . '</a></li>';
    											}
    											
    										}
                                        }
										unset($db_sub);
                                        echo '</ul>';
										echo '</li>';
										$i++;
									}
									unset($db_query);
									?>
                                </ul>
                            </div>
                            <div class="col-md-6 ">
                                <ul class="footer-menu ">
                                    <li><a href="/lien-he.html" class="visible-xs">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix ng-scope"></div>
                    <div class="footer-socials"><a href="<?=$con_link_fb?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="<?=$con_link_insta?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><a href="<?=$con_link_twiter?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>