<?php
$config['app'] = [
    'service' => [
        HtmlHelper::class
    ],
    'routeMiddleware' => [
        // 'trang-chu' => AuthMiddleware::class
    ],
    'globalMiddleware' => [
        ParamsMiddleware::class
    ],
    'boot' => [
        AppServiceProvider::class
    ]
];