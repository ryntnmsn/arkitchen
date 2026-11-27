<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\QuoteRequestReceived;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class QuoteRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'project_details' => ['required', 'string', 'max:10000'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);

        $paths = collect($request->file('photos', []))
            ->map(fn ($photo) => $photo->store('quote-requests', 'local'))
            ->all();

        $quoteRequest = QuoteRequest::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'project_details' => $data['project_details'],
            'attachment_paths' => $paths,
        ]);

        Mail::to(config('mail.to.address'))->send(new QuoteRequestReceived($quoteRequest));

        return redirect()->route('contact.thank-you');
    }
}
