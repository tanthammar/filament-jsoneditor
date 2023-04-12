<?php

namespace InvadersXX\FilamentJsoneditor;

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
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        $this->app->resolving(AssetManager::class, function () {
            \Filament\Support\Facades\FilamentAsset::register([
                Css::make('invaders-filament-jsoneditor-css', __DIR__.'/../dist/jsoneditor/jsoneditor.min.css'),
                Js::make('invaders-filament-jsoneditor-js', __DIR__.'/../dist/jsoneditor/jsoneditor.min.js')
            ], 'InvadersXX/filament-jsoneditor');

        });
    }

    public function packageBooted(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../dist/jsoneditor/img/jsoneditor-icons.svg' => public_path('filament/assets/img/jsoneditor-icons.svg'),
            ], 'invaders-filament-jsoneditor-img');
        }
    }

}
