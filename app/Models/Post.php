<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function scopePublished(Builder $query)
    {
        //view unpublished posts if user has permission to
        if(!auth()->user()?->getAllPermissions()->pluck('name')->contains('view unpublished posts'))
        {
            return $query->where('published', 1);
        }

    }

    public function author()
    {
        return $this->belongsTo('user', 'user_id');
    }
}
