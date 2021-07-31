<?php

declare(strict_types=1);

namespace GoldenGoose\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Database\Factories\SubscriptionFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $title;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('subscriptions.user'));
    }

    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }
}
