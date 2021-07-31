<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Tests\User;
use GoldenGoose\Services\SubscriptionService;
use GoldenGoose\Events\SubscriptionsWasUpdated;
use GoldenGoose\Models\Subscription;

class UpdateSubscriptionsTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCantUpdateSubscriptions(): void
    {
        $this->assertFalse(auth()->check());

        $this->post(route('subscriptions.update'), [
            'subscriptions' => [1, 2]
        ])->assertRedirect(route('login'));
    }

    public function testUserCanUpdateSubscriptions()
    {
        $user = User::factory()->make();
        $subscription = Subscription::create(['title' => 'can update title']);
        $sut = new SubscriptionService();

        $sut->update($user, [$subscription->id]);

        $this->assertEquals($user->subscriptions()->count(), 1);
        $this->assertEquals($user->subscriptions()->first()->id, $subscription->id);

        return $user;
    }

    /**
     * @depends testUserCanUpdateSubscriptions
     */
    public function testUserCanUnsubscribe($user)
    {
        $sut = new SubscriptionService();

        $sut->update($user, null);

        $this->assertEquals($user->subscriptions()->count(), 0);
    }

    public function testValidateRequest()
    {
        $user = User::factory()->make();

        $this->actingAs($user)->post(route('subscriptions.update'), [
           'subscriptions' => [5]
        ])->assertSessionHasErrors(['subscriptions.*']);

        $this->actingAs($user)->post(route('subscriptions.update'))->assertSessionHasNoErrors();
    }

    public function testAnEventIsEmitted(): void
    {
        Event::fake();

        $user = User::factory()->make();
        $sut = new SubscriptionService();
        $sut->update($user, [1]);

        Event::assertDispatched(SubscriptionsWasUpdated::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
