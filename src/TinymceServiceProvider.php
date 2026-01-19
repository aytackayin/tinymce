<?php

namespace Aytackayin\Tinymce;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class TinymceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'aytackayin-tinymce');
        $this->mergeConfigFrom(__DIR__ . '/../config/aytackayin-tinymce.php', 'aytackayin-tinymce');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->publishes([__DIR__ . '/../config/aytackayin-tinymce.php' => config_path('aytackayin-tinymce.php')], 'aytackayin-tinymce-config');
        $this->publishes([__DIR__ . '/../assets/' => public_path('js/tinymce')], 'aytackayin-tinymce-assets');

        $assets = [
            Js::make('tinymce', asset('js/tinymce/js/tinymce/tinymce.min.js')),
            //Js::make('tinymce', 'https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js'),
        ];
        $files = scandir(__DIR__ . '/../assets/js/tinymce/langs/');
        foreach ($files as $file) {
            if (str_contains($file, '.js')) {
                $lang = substr($file, 0, strpos($file, '.js'));
                $assets[] = Js::make('tinymce-lang-' . $lang, asset('js/tinymce/js/tinymce/langs/' . $file))->loadedOnRequest();
            }
        }
        FilamentAsset::register($assets, package: 'aytackayin-tinymce');
    }
}
