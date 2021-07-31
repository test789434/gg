<?php

declare(strict_types=1);

namespace GoldenGoose\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use GoldenGoose\Models\Subscription;

class SubscriptionsWasUpdated
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @var Authenticatable
     */
    public $user;

    /**
     * @var Collection<Subscription>|null
     */
    private $oldSubscriptions;

    public function __construct(Authenticatable $user, $oldSubscriptions)
    {
        $this->user = $user;
        $this->oldSubscriptions = $oldSubscriptions;
    }
}
