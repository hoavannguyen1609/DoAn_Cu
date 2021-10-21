<?php
// Tự động load configs
$config_dir = scandir('configs');
if (!empty($config_dir)) {
    foreach($config_dir as $item) {
        if($item != '.' && $item != '..' && file_exists('configs/'.$item)) {
            require_once("configs/".$item);
        }
    }
}

// Load all service
if(!empty($config['app']['service'])) {
    $allService = $config['app']['service'];
    if(!empty($allService)) {
        foreach($allService as $servieceFile) {
            if(file_exists("app/core/" .$servieceFile .".php")) {
                require_once('app/core/' .$servieceFile .'.php');
            }
        }
    }
}

require_once "PHPMailer/class.phpmailer.php";
require_once "PHPMailer/class.smtp.php";

// load core Service Provider class
require_once 'core/core_ServiceProvider.php';
// load core Views
require_once 'core/core_View.php';
// load core_load
require_once 'core/core_Load.php';
// middleware
require_once 'core/core_Middlewares.php';
require_once 'core/core_Routes.php';
require_once 'core/core_Session.php';

if (!empty($config['database'])) {
    $db_config = array_filter($config['database']);
    if (!empty($db_config)) {
        require_once 'core/core_Connection.php';
        require_once "core/core_QueryBuild.php";
        require_once "core/core_Database.php";
    }
}

require_once 'core/core_helper.php';

$helper_dir = scandir('app/helpers');
if (!empty($helper_dir)) {
    foreach($helper_dir as $item) {
        if($item != '.' && $item != '..' && file_exists('app/helpers/'.$item)) {
            require_once("app/helpers/".$item);
        }
    }
}

require_once "core/core_DB.php";
require_once "app/app.php";
require_once "core/core_DB.php";
require_once "core/core_Model.php";
require_once 'core/core_Template.php';
require_once 'core/core_baseModel.php';
require_once 'core/core_Request.php';
require_once 'core/core_Response.php';