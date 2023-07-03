<?php

namespace Vendor\LaravelSanitize;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class LaravelSanitizeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        // configファイルを公開します
        // php artisan vendor:publish --provider="Vendor\MyPackage\MyPackageServiceProvider" --tag="config"
        // を実行することで、ユーザーはパッケージの設定をカスタマイズできます
        $this->publishes([
            __DIR__.'/config/const.php' => config_path('const.php'),
        ], 'config');

        $kernel->pushMiddleware(SanitizeInput::class);
    }
}
