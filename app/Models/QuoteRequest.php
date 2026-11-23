<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'project_details', 'attachment_paths'];

    protected function casts(): array
    {
        return ['attachment_paths' => 'array'];
    }
}
