<?
// Lấy danh sách sp của cat
$page_size  = 9;
$page       = getValue("page", "int", "GET", 1);
$total_page = 0;
$list_news  = getListNew($infoCategory["cat_id"], ($page -1) * $page_size, $page_size);

$total_news = getCountNews($infoCategory["cat_id"]);

if($total_news % $page_size > 0){
	$total_page    = (floor($total_news / $page_size)) + 1;
}else{
	$total_page    = floor($total_news / $page_size);
}

?>

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
            <li id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope"><?=$nCat?></span></li>
        </ul>
    </div>
    <div></div>
    <div class="container">
        <div class="page-header-title portfolio">
            <h1><?=$nCat?></h1>
            <div class="title-caption merriw"><a href="#" class="readmore-link blog-form-anchor">Danh mục liên quan<span class="arr"></span></a></div>
        </div>
    </div>
</div>
<div class="page-filters">
    <div class="container">
      <div class="blog-filter">
        <?
          $db_cat = new db_query("SELECT * FROM categories_multi WHERE cat_type = 'news' AND cat_parent_id != 0 ORDER BY cat_order ASC");
          while ($row_cat = mysqli_fetch_assoc($db_cat->result)) {
            $link_cat = createlink("news", array('nTitle' => $row_cat['cat_name']));
            $select   = "";
            if($nRwrite == $row_cat['cat_name_rewrite']){
              $select = " selected";
            }
              ?>
                <div class="filter-item">
                  <input type="radio" name="blog_category_empty" id="cat_all" value="" class="ng-empty">
                  <a href="<?=$link_cat?>"><label for="cat_all" class="<?=$select?>"><?=$row_cat['cat_name']?></label></a>
              </div>
              <?
          }
          unset($db_cat);
        ?>
      </div>
    </div>
</div>
<div class="list_news">
    <div class="container">
        <div class="blog-list-container">
            <div class="blog-list" id="blog-list">
              <?
              foreach ($list_news as $key => $value) {
                    $news_pic   = getUrlImageNews($value['new_picture'],"");
                    $array_info = array("nTitle" => $value['new_title'], "iData" => $value['new_id']);
                    $news_url   = createlink('news_detail', $array_info);
                ?>
                <div class="blog-item-container ">
                    <a href="<?=$news_url?>" class="blog-item">
                        <div class="blog-preview-img" style="background-image: url('<?=$news_pic?>');">
                            <div class="blog-item-category"><?=$value['cat_name']?></div>
                        </div>
                        <div class="blog-item-announce">
                            <div class="blog-item-title merriw"><?=$value['new_title']?></div>
                        </div>
                    </a>
                </div>
                <?
              }
              ?>

                <div class="ng-scope"></div>
                <br>
                <?  
              
                  if($total_page > 1 && $total_page != $page){
                    echo '<a href="'. createlink("news", array("nTitle" => $infoCategory["cat_name"],"iData" => $infoCategory["cat_id"])).',page-'. intval($page + 1) . '" class="readmore-link right" id="showall" data-show-more="PAGEN_1" data-next-page="2" data-limit="99999">Trang tiếp<span class="arr"></span></a>';
                  }
               
                ?>
               
                
            </div>
        </div>
    </div>
</div>
<?
    $name    = getValue("name", "str", "POST", "");
    $phone   = getValue("phone", "str", "POST", "");
    $email   = getValue("email", "str", "POST", "");
    $message = getValue("message", "str", "POST", "");
    $action  = getValue("action", "str", "POST", "");
    if($action == "contact"){
        $db_ex = new db_execute("INSERT INTO contact (cot_full_name,cot_email,cot_phone,cot_content,cot_create_time) VALUES 
            ('" . $name . "','" . $phone . "','" . $email . "','" . $message . "'," . time() . ")");
        echo '<script type="text/javascript">
        alert("Cảm ơn bạn đã gửi liên hệ! Chúng tôi sẽ gọi lại sớm nhất cho bạn!");
        window.location.href = "/";
    </script>';
    }
    ?>
<div class="form-wrap margin-top-0 margin-bottom-150">
      <form name="callback" class="page-bottom-form" method="post">
          <div class="text-spec-block">
              <h2 class="gold h1">Để lại liên hệ</h2>
              <h3 class="h3 white">Chúng tôi sẽ gọi lại sớm cho bạn</h3></div>
          <div class="form-fields">
              <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="name"                             type="text"                             id="page-35"                            required /><label class="input__label input__label--madoka" for="page-35"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Tên</span></label>
                          </span>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group"><span class="input input--madoka madoka_white"><input class="input__field input__field--madoka"                            name="phone"                            id="page-36"                            type="text"                    required /><label class="input__label input__label--madoka" for="page-36"><svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none"><path d="m0,0l404,0l0,77l-404,0l0,-77z" /></svg><span class="input__label-content input__label-content--madoka">Số điện thoại</span></label>
                          </span>
                      </div>
                  </div>
                  <input type="hidden" name="action" value="contact">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <div class="form-submit">
                              <button type="submit" class="readmore-link">Gửi<span class="arr"></span></button>
                          </div>
                      </div>
                  </div>
              </div>
           </div>
          <div class="clearfix"></div>
      </form>
  </div>