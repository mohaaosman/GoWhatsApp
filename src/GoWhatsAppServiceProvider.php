<?php

namespace Zifala\GoWhatsApp;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GoWhatsAppServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('go-whatsapp')
            ->hasConfigFile()
            ->hasMigration('create_go_whatsapp_logs_table')
            ->hasMigration('create_go_whatsapp_devices_table');
    }

    public function packageRegistered()
    {
        // Bind the Connector Singleton using config
        $this->app->singleton(GoWhatsAppConnector::class, function () {
            return new GoWhatsAppConnector(
                baseUrl: config('go-whatsapp.base_url'),
                username: config('go-whatsapp.username'),
                password: config('go-whatsapp.password')
            );
        });
    }
}
