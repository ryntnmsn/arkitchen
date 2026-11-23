<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Throwable;

class DesignRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'location' => ['required', 'string', 'max:160'],
            'room_description' => ['required', 'string', 'max:3000'],
            'dimensions' => ['nullable', 'string', 'max:300'],
            'style' => ['required', 'in:calm-modern,warm-natural,classic-clean'],
            'color' => ['required', 'in:soft-white,warm-oak,deep-walnut,earthy-red'],
            'budget' => ['nullable', 'string', 'max:100'],
            'photos' => ['nullable', 'array', 'max:3'],
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'ai_consent' => ['accepted'],
        ]);

        $photoFiles = $request->file('photos', []);
        $photoPaths = collect($photoFiles)
            ->map(fn ($photo) => $photo->store('design-requests', 'local'))
            ->all();

        $designRequest = DesignRequest::create([
            ...collect($data)->except(['photos', 'ai_consent'])->all(),
            'photo_paths' => $photoPaths,
        ]);

        $imagePath = $this->generateConceptImage($data, $photoFiles);

        if ($imagePath) {
            $designRequest->update(['generated_image_path' => $imagePath, 'status' => 'concept_ready']);
        }

        $previewUrl = $imagePath
            ? URL::temporarySignedRoute('design.preview', now()->addDays(7), ['designRequest' => $designRequest->id])
            : null;

        return redirect()->route('designer')->with('concept', [
            'id' => $designRequest->id,
            'imageUrl' => $previewUrl,
            'name' => $data['name'],
            'style' => $data['style'],
            'color' => $data['color'],
            'room' => $data['room_description'],
            'dimensions' => $data['dimensions'] ?? null,
        ]);
    }

    /** @param array<int, \Illuminate\Http\UploadedFile> $photos */
    private function generateConceptImage(array $data, array $photos): ?string
    {
        $apiKey = config('services.openai.api_key');

        if (! $apiKey) {
            return null;
        }

        $style = str_replace('-', ' ', $data['style']);
        $color = str_replace('-', ' ', $data['color']);
        $prompt = "Create a photorealistic, premium but practical modular cabinet design concept for a homeowner in Central Visayas. The requested style is {$style}; the preferred cabinet color/material direction is {$color}. Room description: {$data['room_description']}. Approximate dimensions: ".($data['dimensions'] ?: 'not provided').'. Show a believable built-in cabinet installation, warm natural daylight, clean composition, realistic proportions, no people, no text, no logos. This is an early visual concept only, not a construction plan; prioritize an illustrative design direction over exact measurements.';

        try {
            $request = Http::timeout(120)->withToken($apiKey);

            foreach (array_slice($photos, 0, 3) as $index => $photo) {
                $request = $request->attach('image[]', file_get_contents($photo->getRealPath()), 'room-reference-'.$index.'.'.$photo->getClientOriginalExtension());
            }

            if (count($photos)) {
                $response = $request->post('https://api.openai.com/v1/images/edits', [
                    'model' => config('services.openai.image_model'),
                    'prompt' => $prompt,
                    'quality' => 'medium',
                    'size' => '1536x1024',
                ]);
            } else {
                $response = Http::timeout(120)->withToken($apiKey)->post('https://api.openai.com/v1/images/generations', [
                    'model' => config('services.openai.image_model'),
                    'prompt' => $prompt,
                    'quality' => 'medium',
                    'size' => '1536x1024',
                ]);
            }

            if (! $response->successful() || ! ($image = $response->json('data.0.b64_json'))) {
                return null;
            }

            $bytes = base64_decode($image, true);

            if ($bytes === false) {
                return null;
            }

            $path = 'design-concepts/'.uniqid('concept-', true).'.png';
            if (! Storage::disk('local')->put($path, $bytes)) {
                return null;
            }

            return $path;
        } catch (Throwable) {
            return null;
        }
    }
}
