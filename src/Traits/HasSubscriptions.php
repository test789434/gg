<?php

declare(strict_types=1);

namespace GoldenGoose\Traits;

use GoldenGoose\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasSubscriptions
{
    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }
}
