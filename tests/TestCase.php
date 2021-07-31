<?php

declare(strict_types=1);

namespace Tests;

use GoldenGoose\SubscriptionServiceProvider;
use CreateSubscriptionsTable;
use CreateSubscriptionUserTable;
use Illuminate\Routing\Router;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SubscriptionServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_subscriptions_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_subscription_user_table.php.stub';

        (new CreateSubscriptionsTable)->up();
        (new CreateSubscriptionUserTable)->up();

        $router = $app->make(Router::class);
        $router->get('/login', function () {})->name('login');
    }
}
