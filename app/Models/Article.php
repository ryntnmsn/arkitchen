<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'excerpt', 'content', 'published_at'])]
class Article extends Model
{
    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
