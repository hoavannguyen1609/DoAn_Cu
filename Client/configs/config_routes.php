<?php 
// shortcut url
$routes['default_controller'] = "C_home";

//product
$routes['dienthoai'] = 'home/selectMobile';
$routes['laptop'] = 'home/selectLaptop';
$routes['tablet'] = 'home/selectTablet';
$routes['amthanh'] = 'home/selectAmthanh';
$routes['dongho'] = 'home/selectWatch';
$routes['tainghe'] = 'home/selectHeadphone';
$routes['san-pham'] = 'home/getDetail';

// customer
$routes['tai-khoan'] = 'customer/index';
$routes['don-mua-cua-toi'] = 'customer/customerOrder';
$routes['sign-out'] = 'customer/signout';
$routes['doi-mat-khau'] = 'customer/changePassword';
$routes['forget-pass'] = 'customer/forgetPass';
$routes['xac-minh-tai-khoan'] = 'customer/confirmOTP';
$routes['dat-lai-mat-khau'] = 'customer/resetPass';
$routes['dat-hang-thanh-cong'] = 'customer/orderPaynow';

// đăng ký
$routes['dang-ky'] = 'registration/index';
$routes['createAccount'] = 'registration/createAccount';

// pay
$routes['mua-ngay'] = 'pay/payNow';
$routes['thanh-toan'] = 'pay/index';

// Đặt hàng
$routes['dat-don'] = 'cart/putOrder';
// $routes['tin-tuc/.+-(\d+).html'] = 'news/index/$1';
// $routes['tin-tuc/(\d+)'] = 'news/index/$1';