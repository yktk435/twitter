<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 開発環境用設定
        if (App::isLocal()) {
            // N+1が発生した時に落ちるようにする
            Model::preventLazyLoading(!app()->isProduction());
        }

        // バリデーションしていない配列の中身を除外する
        Validator::excludeUnvalidatedArrayKeys();
    }
}
