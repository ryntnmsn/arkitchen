<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DesignPreviewController extends Controller
{
    public function __invoke(DesignRequest $designRequest): BinaryFileResponse
    {
        abort_unless($designRequest->generated_image_path && Storage::disk('local')->exists($designRequest->generated_image_path), 404);

        return response()->file(Storage::disk('local')->path($designRequest->generated_image_path), [
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}
