<?php
// Xử lý http or htpps
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
} 
else { 
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '',str_replace('\\','/',strtolower(__DIR__)));

$web_root .= $folder;

$webUrlArr = explode('/',$web_root);

unset($webUrlArr[count($webUrlArr) -1]);

$webImg = implode('/',$webUrlArr);

define('_DIR_ROOT',__DIR__);

define('_WEB_ROOT',$web_root);

define('_URL_IMG',$webImg.'/');

define('_IMG_PRODUCT',_URL_IMG.'imageAll/imgProduct/');

// define('_IMG_MOBILE',_IMG_PRODUCT.'mobile/');

// define('_IMG_TABLET',_IMG_PRODUCT.'tablet/');

// define('_IMG_LAPTOP', _IMG_PRODUCT.'laptop/');

// define('_IMG_WATCH', _IMG_PRODUCT.'dongho/');

// define('_IMG_ACCESSORY', _IMG_PRODUCT.'phukien/');

// define('_IMG_SPEAK', _IMG_PRODUCT.'loa/');

define('_IMG_SLIDE',_URL_IMG.'/imageAll/imgSlide/');

define('_IMG_FRONT',_URL_IMG.'/imageAll/imgFront/');

define('_IMG_ICON',_URL_IMG.'/imageAll/imgIcon/');

// define('_URL_MOBILE',_WEB_ROOT.'/dien-thoai/');

// define('_URL_LAPTOP',_WEB_ROOT.'/lap-top/');

// define('_URL_WTACH',_WEB_ROOT.'/dong-ho/');

// define('_URL_ACCESSORY',_WEB_ROOT.'/tai-nghe/');

// define('_URL_SPEAK',_WEB_ROOT.'/loa/');

// define('_URL_TABLET',_WEB_ROOT.'/tablet/');

define('_AVATAR_CUSTOMER',_WEB_ROOT.'/public/plugin/');

define('_URL_PRODUCT',_WEB_ROOT .'/san-pham/');