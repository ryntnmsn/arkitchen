<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LeadController extends Controller
{
    public function quotes(): Response
    {
        return Inertia::render('Admin/Leads/Quotes', [
            'requests' => QuoteRequest::query()->latest()->paginate(15)->through(fn (QuoteRequest $item) => [
                'id' => $item->id, 'name' => $item->name, 'phone' => $item->phone, 'email' => $item->email,
                'details' => $item->project_details, 'created_at' => $item->created_at->toDateTimeString(),
                'attachments' => collect($item->attachment_paths ?? [])->map(fn ($path, $index) => ['index' => $index, 'name' => basename($path)]),
            ]),
        ]);
    }

    public function designs(): Response
    {
        return Inertia::render('Admin/Leads/Designs', [
            'requests' => DesignRequest::query()->latest()->paginate(15)->through(fn (DesignRequest $item) => [
                'id' => $item->id, 'name' => $item->name, 'phone' => $item->phone, 'email' => $item->email,
                'location' => $item->location, 'description' => $item->room_description,
                'dimensions' => $item->dimensions, 'style' => $item->style, 'color' => $item->color,
                'status' => $item->status, 'created_at' => $item->created_at->toDateTimeString(),
                'conceptUrl' => $item->generated_image_path ? URL::temporarySignedRoute('design.preview', now()->addDays(7), ['designRequest' => $item->id]) : null,
                'attachments' => collect($item->photo_paths ?? [])->map(fn ($path, $index) => ['index' => $index, 'name' => basename($path)]),
            ]),
        ]);
    }

    public function quoteAttachment(QuoteRequest $quoteRequest, int $index): BinaryFileResponse
    {
        $path = ($quoteRequest->attachment_paths ?? [])[$index] ?? null;
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return response()->download(Storage::disk('local')->path($path));
    }

    public function designAttachment(DesignRequest $designRequest, int $index): BinaryFileResponse
    {
        $path = ($designRequest->photo_paths ?? [])[$index] ?? null;
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return response()->download(Storage::disk('local')->path($path));
    }
}
