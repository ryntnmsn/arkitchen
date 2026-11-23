<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'location', 'room_description', 'dimensions', 'style', 'color', 'budget', 'photo_paths', 'generated_image_path', 'status'];

    protected function casts(): array
    {
        return ['photo_paths' => 'array'];
    }
}
