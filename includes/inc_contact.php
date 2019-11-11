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
            <li id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-arr"></span><span class="ng-binding ng-scope">Liên hệ</span></li>
        </ul>
    </div>
    <div></div>
    <div class="container">
        <div class="page-header-title ">
            <h1>Liên lạc với chúng tôi</h1>
        </div>
    </div>
</div>
<div class="inner-page-content contacts-page">
<div class="contacts-top">
    <div class="page-square"></div>
    <div class="contacts-top-adress"><?=$con_site_title?>              
            <div class="adress-caption"><?=$con_address?></div>
        </div>
        <div class="contacts-top-phones">
            <?=$con_info_company?>
        </div>
        <div class="contacts-top-img">
            <img alt="Офис Studia-54" src="/data/background/<?=$con_img_contact?>">
        </div>
</div>
</div>
<div class="container">
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
    </div>
