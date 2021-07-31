<?php

namespace GoldenGoose\Services;

use Illuminate\Contracts\Auth\Authenticatable;

interface SubscriptionServiceInterface
{
    public function update(Authenticatable $user, ?array $subscriptions): void;
}
