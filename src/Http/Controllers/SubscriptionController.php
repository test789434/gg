<?php

declare(strict_types=1);

namespace GoldenGoose\Http\Controllers;

use GoldenGoose\Models\Subscription;
use GoldenGoose\Http\Requests\UserSubscriptionsRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use GoldenGoose\Services\SubscriptionServiceInterface;

class SubscriptionController extends Controller
{
    /** @var SubscriptionServiceInterface */
    private $subscriptionService;

    public function __construct(SubscriptionServiceInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(): View
    {
        return view(
            'subscriptions::index',
            [
                'subscriptions' => Subscription::get(),
                'currentSubscriptions' => auth()->user()->subscriptions()->pluck('id')
            ]
        );
    }

    public function updateSubscriptions(UserSubscriptionsRequest $request): RedirectResponse
    {
        $this->subscriptionService->update(auth()->user(), $request->subscriptions);

        return redirect()->back()->with('success', 'Your subscriptions was updated.');
    }
}
