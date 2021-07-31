<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'subscriptions',
        'namespace' => 'GoldenGoose\Http\Controllers',
        'middleware' => ['web', 'auth'],
    ],
    static function () {
        Route::get('/', ['uses' => 'SubscriptionController@index', 'as' => 'subscriptions.index']);
        Route::post('/', ['uses' => 'SubscriptionController@updateSubscriptions', 'as' => 'subscriptions.update']);
    }
);
