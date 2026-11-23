<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email', 'max:255']]);

        NewsletterSubscription::firstOrCreate(['email' => $data['email']]);

        return back()->with('newsletterSuccess', 'Thanks for subscribing!');
    }
}
