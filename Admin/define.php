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

define('_AVATAR_ADMIN',_WEB_ROOT.'/public/plugin/');

define('_ICON_',_URL_IMG.'icon/');

define('_IMG_PRODUCT',_URL_IMG.'/imageAll/imgProduct/');

define('_IMG_SLIDE',_URL_IMG.'/imageAll/imgSlide/');

define('_IMG_FRONT',_URL_IMG.'/imageAll/imgFront/');

define('_IMG_ICON',_URL_IMG.'/imageAll/imgIcon/');