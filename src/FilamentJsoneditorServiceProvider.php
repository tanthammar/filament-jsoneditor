<?php

namespace InvadersXX\FilamentJsoneditor;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\AssetManager;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJsoneditorServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-jsoneditor')
            //->hasAssets()
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        if($this->app->runningInConsole()) {
            $this->app->resolving(AssetManager::class, function () {
                \Filament\Support\Facades\FilamentAsset::register([
                    Css::make('filament-jsoneditor', __DIR__.'/../resources/dist/js/filament-jsoneditor.css'),
                    Js::make('filament-jsoneditor', __DIR__.'/../resources/dist/js/filament-jsoneditor.js'),
                ], 'invadersxx/filament-jsoneditor');
            });
        }

    }

/*    public function packageBooted(): void
    {
        //OBS importerar css i js som har svg, dessa konverteras automatiskt med npx --loader (se nedan) så de behöver ej exporteras längre
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/js/img/jsoneditor-icons.svg' => public_path('filament/assets/img/jsoneditor-icons.svg'),
            ], 'filament-jsoneditor-assets');
        }
    }*/

    /** commands
     * first compile the js and css, then publish the assets with Filament upgrade command
     * npx esbuild resources/js/filament-jsoneditor.js --outfile=resources/dist/js/filament-jsoneditor.js --loader:.svg=dataurl --bundle --minify --platform=neutral
     * php artisan filament:upgrade
     */

}
