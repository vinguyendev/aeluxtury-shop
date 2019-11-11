<div class="inner-page-header">
    <div class="page-header-square"></div>
    <div class="page-lines">
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
        <div class="page-line"></div>
    </div>
    <div class="page-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
      <a href="/" class="" itemprop="item">
        <span itemprop="name" style="opacity: 1">Trang chủ</span>
      </a>
        <meta itemprop="position" content="1">
        </span>
        <ul class="breadcrumb ng-isolate-scope">
            <li id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope"><?=$news_info['cat_name']?></span></li>
            <li id="bx_breadcrumb_1" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope"><?=$news_info['new_title']?></span></li>
        </ul>
    </div>
    <div></div>
    <div class="container">
        <div class="page-header-title ">
            <h1><?=$news_info['new_title']?></h1>
        </div>
    </div>
</div>

<div class="container content_news">
	<?=$news_info['new_teaser']?><br/><br/>
	<?=$news_info['new_description']?>
</div>

<div class="other-projects " style="padding-top: 30px;">
    <div class="container ">
    	<div class="row">
	        <div class="text-spec-block" style="margin:0;">
	            <h2 class="h1 white"><?=$news_info['cat_name']?></h2>
	            <h3 class="h3 white">Bài viết liên quan</h3></div>
	        <div class="blog-list">
	            <div class="row">
	            	<?
	                $db_select = new db_query("SELECT * FROM news_multi, categories_multi 
	                                                                WHERE new_category_id = cat_id 
	                                                                AND cat_type = 'news' 
	                                                                AND new_id <> ".$recordId ." ORDER BY RAND() LIMIT 2 ");
	                while ($row = mysqli_fetch_assoc($db_select->result)){
	                	$news_pic   = getUrlImageNews($row['new_picture'],"");
	                    $array_info = array("nTitle" => $row['new_title'], "iData" => $row['new_id']);
	                    $news_url   = createlink('news_detail', $array_info);
		                ?>
		                	<div class="blog-item-container container-half">
			                    <a href="<?=$news_url?>" class="blog-item">
			                        <div class="blog-preview-img" style="background-image: url('<?=$news_pic?>');">
			                            <div class="blog-item-category"><?=$row['cat_name']?></div>
			                        </div>
			                        <div class="blog-item-announce">
			                            <div class="blog-item-title merriw"><?=$row['new_title']?></div>
			                        </div>
			                    </a>
			                </div>
		                <?
		                } 
		                unset($db_select);
		            	?>
	                
	                <div class="ng-scope"></div>
	            </div>
	        </div>
        </div>
    </div>
</div>

<style type="text/css">
	.content_news{
		padding: 20px 10px;
	}
	.content_news p,.content_news h1,.content_news h2{
		color: #fff !important;
		
	}
	.content_news p{
		font-size: 16px !important;
	}
</style>