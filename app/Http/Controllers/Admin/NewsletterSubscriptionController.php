<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class NewsletterSubscriptionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Newsletter/Index', [
            'subscriptions' => NewsletterSubscription::query()->latest()->paginate(20),
        ]);
    }

    public function destroy(NewsletterSubscription $subscription): RedirectResponse
    {
        $subscription->delete();

        return back()->with('success', 'Subscription removed.');
    }
}
