<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Zifala\GoWhatsApp\GoWhatsAppServiceProvider;
use Saloon\Laravel\SaloonServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            SaloonServiceProvider::class,
            GoWhatsAppServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function defineDatabaseMigrations()
    {
        $migration1 = include __DIR__ . '/../database/migrations/create_go_whatsapp_devices_table.php.stub';
        $migration1->up();

        $migration2 = include __DIR__ . '/../database/migrations/create_go_whatsapp_logs_table.php.stub';
        $migration2->up();
    }
}
