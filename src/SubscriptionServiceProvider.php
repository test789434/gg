<?php

declare(strict_types=1);

namespace GoldenGoose;

use Illuminate\Support\ServiceProvider;
use GoldenGoose\Services\SubscriptionServiceInterface;
use GoldenGoose\Services\SubscriptionService;

class SubscriptionServiceProvider extends ServiceProvider
{
    private const PATH_MIGRATIONS = __DIR__ . '/../database/migrations/';

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/subscriptions.php', 'subscriptions');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            if (!class_exists('CreateSubscriptionsTable')) {
                $this->publishes(
                    [
                        self::PATH_MIGRATIONS . 'create_subscriptions_table.php.stub' => $this->createMigrationName(
                            'create_subscriptions_table', 1
                        ),
                        self::PATH_MIGRATIONS . 'create_subscription_user_table.php.stub' => $this->createMigrationName(
                            'create_subscription_user_table', 2
                        )
                    ],
                    'migrations'
                );
            }
        }

        $this->publishes(
            [
                __DIR__ . '/../config/subscriptions.php' => config_path('subscriptions.php')
            ],
            'config'
        );

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'subscriptions');

        $this->app->bind(SubscriptionServiceInterface::class, SubscriptionService::class);
    }

    private function createMigrationName(string $name, int $order): string
    {
        return database_path(
            'migrations/' . date('Y_m_d_His', time() + $order) . "_$name.php"
        );
    }
}
