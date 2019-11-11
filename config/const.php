<?
$includes_dir     = dirname(__FILE__);
$classes_dir    	= str_replace("config", "classes", $includes_dir);


define("ROOT_PATH", "/");
define("DOMAIN_SITE", "h");
define("LANG_PATH", "/");
define("WARNING_PATH", "/home/warning.php");


//Biến config xem có dùng memcache không( 0: Không dùng, 1: Có dùng)
define("CONFIG_MEMCACHE", 0);

// URL ảnh + css + js
define("STATIC_PATH", "/");

// URL ảnh
define("IMAGE_PATH", "/data/product/");
define("PICTURE_PATH", "/data/");
define("IMAGE_PATH_BANNER", "/data/banner/");
define("IMAGE_PATH_PRODUCT", "/data/product/");
define("IMAGE_PATH_PROJECT", "/data/project/");
define("IMAGE_PATH_ALBUM", "/data/album/");
define("IMAGE_PATH_FEED", "/data/feedback/");
define("IMAGE_PATH_NEW", "/data/new/");
define("IMAGE_PATH_COMMENT", "/data/comment/");
define("IMAGE_PATH_MENU", "/data/menu/");
define("IMAGE_PATH_COURSE", "/data/course/");

define("BACKGROUND_HOME_SHOP", STATIC_PATH . "css/images/icon_home_shop.png");
define('BACKGROUND_STORE_MOBILE', '<img src="' . STATIC_PATH . 'css/images/home_m_add.jpg" />');
define('BACKGROUND_MEGAFASHION_CONTACT', '<img src="' . STATIC_PATH . 'css/images/megafashion-contact.jpg" />');
define('BACKGROUND_POLICY', '<img src="' . STATIC_PATH . 'css/images/doitrahang.png" />');
?>