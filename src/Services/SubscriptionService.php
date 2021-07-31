<?php

declare(strict_types=1);

namespace GoldenGoose\Services;

use GoldenGoose\Events\SubscriptionsWasUpdated;
use Illuminate\Contracts\Auth\Authenticatable;

class SubscriptionService implements SubscriptionServiceInterface
{
    public function update(Authenticatable $user, ?array $subscriptions): void
    {
        $oldSubscriptions = $user->subscriptions;

        $user->subscriptions()->sync($subscriptions);

        event(new SubscriptionsWasUpdated($user, $oldSubscriptions));
    }
}
