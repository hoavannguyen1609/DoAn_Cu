<?php
$config['app'] = [
    'service' => [
        HtmlHelper::class
    ],
    'routeMiddleware' => [
        'trang-chu' => AuthMiddleware::class
        // 'tai-khoan' => CustomerMiddleware::class
    ],
    'globalMiddleware' => [
        ParamsMiddleware::class
    ],
    'boot' => [
        AppServiceProvider::class
    ]
];