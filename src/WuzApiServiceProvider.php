<?php

namespace Bayurifkialghifari\WuzApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WuzApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('wuzapi')
            ->hasConfigFile('wuzapi');
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(WuzApiClient::class, function ($app) {
            return new WuzApiClient(
                baseUrl: config('wuzapi.base_url', 'http://localhost:8080'),
                token: config('wuzapi.token'),
            );
        });

        $this->app->alias(WuzApiClient::class, 'wuzapi');
    }
}
