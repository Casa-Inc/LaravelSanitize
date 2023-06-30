<?php

namespace LaravelSanitize\config;

return [
    'NOT_SANITIZE' => [
        'get/hoge' => [
            'password',
        ],
        'api/get/excess_amount/list' => [
            'management_company',
        ],
    ],
];