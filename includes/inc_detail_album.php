<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
		<div class="main-content tie-col-md-12" role="main">
			<article id="the-post" class="container-wrapper post-content">
				<header class="entry-header-outer">
					<nav id="breadcrumb"><a href="/"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current"><?=$con_site_title?></span></nav>
					<div class="entry-header">
						<h1 class="post-title entry-title"><?=$con_site_title?></h1>
					</div>
				</header>
			</article>
			<div id="tiepost-821-section-1968" class="section-wrapper container normal-width without-background">
				<div class="section-item full-width">
					<section id="tie-block_1538" class="slider-area mag-box">
						<div id="tie-main-slider-1-block_1538" class="tie-main-slider main-slider fullwidth-slider-wrapper wide-slider-wrapper tie-slick-slider-wrapper" data-slider-id="1" data-speed="3000">
							<div class="main-slider-inner">
								<div class="container slider-main-container">
									<div class="tie-slick-slider">
										<ul class="tie-slider-nav"></ul>
										<?
										$count = count($arrPicture);
										foreach ($arrPicture as $key => $value) {
											?>
											<div class="slide lazy-bg slide-id-1959 tie-slide-1 is-trending tie-video">
												<img data-lazy="<?=getUrlImageAlbum($value['name'])?>" src="<?=getUrlImageAlbum($value['name'])?>" width="2000" height="2000" alt="">
												<div class="slide-bg" style=" background-size: contain;"></div>
											</div>
											<?
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="detail_album_main">
							<h3>THÔNG TIN:</h3>
							<div class="dam_text"><?=$albDescription?></div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>