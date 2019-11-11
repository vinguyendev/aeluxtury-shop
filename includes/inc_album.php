<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
		<div class="main-content tie-col-md-12" role="main">
			<article id="the-post" class="container-wrapper post-content">
				<header class="entry-header-outer">
					<nav id="breadcrumb"><a href="/"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current">Bộ sưu tập</span></nav>
					<div class="entry-header">
						<h1 class="post-title entry-title">Bộ sưu tập</h1>
					</div>
				</header>
				<div class="entry-content entry clearfix" style=""> </div>
			</article>
			<div class="post-components"> </div>
			<div class="masonry-page-content clearfix">
				<div id="media-page-layout" class="masonry-grid-wrapper media-page-layout masonry-with-spaces">
					<div class="loader-overlay">
						<div class="spinner-circle"></div>
					</div>
					<div id="masonry-grid" data-layout="overlay" data-settings="{'uncropped_image':'jannah-image-grid','category_meta':'true','post_meta':'true','excerpt':'true','excerpt_length':'20','read_more':true,'title_length':0,'is_full':true}">
						<?
						$db_query = new db_query("SELECT * FROM album WHERE alb_active = 1 ORDER BY alb_id DESC LIMIT 30");
						while ($row = mysqli_fetch_assoc($db_query->result)) {
							$link = createlink("album", array("iData" => $row["alb_id"], "nTitle" => $row["alb_title"]));
							?>
							<div class="container-wrapper post-element is-trending">
								<div style="background-image: url(<?=getUrlImageAlbum($row['alb_image'])?>)" class="slide">
									<a href="javascript:;" title="<?=$row['alb_title']?>" class="all-over-thumb-link"></a>
									<div class="thumb-overlay">
										<div class="thumb-content">
											<h3 class="thumb-title"><a href="<?=$link?>"><?=$row['alb_title']?></a></h3>
										</div>
									</div>
								</div>
							</div>
							<?
						}
						unset($db_query);
						?>
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
					</div>
				</div>
				<!-- <div class="pages-nav"><a data-text="Load More" data-page="1" onclick="addProductToCart();" id="load-more" class="container-wrapper show-more-button load-more-button ">Load More</a></div> -->
			</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript">
	function addProductToCart(){
		var page = $("#load-more").attr("data-page");

		$.ajax({
			url: "/ajax/show_more_album.php",
			type: "POST",
			data: {page : page},
			success: function(data){
				$(".masonry-page-content").append(data);
				$("#load-more").attr("data-page",parseInt(page) + 1);
			},
			dataType : "html"
		});
	}
</script> -->