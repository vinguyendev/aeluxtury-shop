<?
// Lấy các danh mục static
$arrayCategory 	= array();
$db_query = new db_query("SELECT * FROM categories_multi WHERE cat_type='static' AND cat_active = 1 ORDER BY cat_order ASC");
while($row = mysqli_fetch_assoc($db_query->result)){
	$arrayCategory[$row['cat_id']] 	= $row;
}
unset($db_query);

// Lấy bài viết
$arrayStatic 	= array();
$db_query 		= new db_query("SELECT * FROM statics WHERE sta_active = 1 AND sta_category_id IN(" . convert_array_to_list(array_keys($arrayCategory)) . ") ORDER BY sta_order ASC");
while($row = mysqli_fetch_assoc($db_query->result)){
	$arrayStatic[$row['sta_category_id']][$row['sta_id']] 	= $row;
}
unset($db_query);
?>
<div id="content" class="site-content container">
	<div class="tie-row main-content-row">
		<div class="main-content tie-col-md-12" role="main">
			<article id="the-post" class="container-wrapper post-content" style="    padding: 10px;">
				<header class="entry-header-outer">
					<nav id="breadcrumb"><a href="/"><span class="fa fa-home" aria-hidden="true"></span> Trang chủ</a><em class="delimiter">/</em><span class="current"><?=$arrayInfoStatic['sta_title']?></span></nav>
					<div class="entry-header" style="padding: 0;">
						<h1 class="post-title entry-title"><?=$arrayInfoStatic['sta_title']?></h1>
					</div>
				</header>
			</article>
			<div class="container">
				<div class="tie-row">
					<div class="tie-col-md-12">
						<div class="contact-info">
							<div class="single-info phone-number">
								<br/>
								<?=$arrayInfoStatic['sta_description']?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
