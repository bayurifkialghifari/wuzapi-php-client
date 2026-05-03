<?php

namespace Bayurifkialghifari\WuzApi\Tests;

use Bayurifkialghifari\WuzApi\WuzApiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            WuzApiServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('wuzapi.base_url', 'http://localhost:8080');
        config()->set('wuzapi.token', 'test-token');
    }
}
