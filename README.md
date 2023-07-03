## 実装手順
1.laravelのリポジトリ内のconfig配下にsanitize_input.phpを追加する

※下記サンプルコード

```php
<?php

return [
    // エスケープしたくないパラメーターは記載する
    'NOT_SANITIZE' => [
        // URLごとに配列を作成
        'get/hoge' => [
            // URLのパラメーター
            'password',
        ]
    ],
];
```

2.composer.jsonに下記を追加する

```json
"require": {
    "casa-inc/laravel-sanitize": "dev-main"
},
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Casa-Inc/LaravelSanitize.git"
    }
]
```
3.コマンド実行

```
composer install
```

## 正規表現
エスケープ箇所 src/Middleware/SanitizeInput.php:23行目
```php
preg_replace("/([\;\#(\-\-)\:\(\)\=])/", '\\\$1', $requestParamData);
```