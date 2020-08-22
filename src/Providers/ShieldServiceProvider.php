<?php

namespace Shield\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Shield\View\Components\Close;
use Shield\View\Components\Open;
use Shield\View\Components\Text;

class ShieldServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/shield.php', 'shield'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // App\resources/views/vendor/shieldのパスも登録される
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'shield');

        // @todo : ここ設定ファイルとかに切り出さないと拡張が出来ない？
        $this->loadViewComponentsAs('shield', [
            Text::class,
            Open::class,
            Close::class
        ]);//*/

        // @todo : ここも設定ファイルに切り出せば呼び出せる？
        // これで無名コンポーネントを呼び出せる(第1引数: bladeファイル、第2引数 : エイリアス)
        Blade::component('shield::components.hoge', 'shield-hoge');

        // publishesを定義する
        $this->publishes([
            __DIR__ . '/../../config/shield.php' => config_path('shield.php'),
        ]);
    }
}
