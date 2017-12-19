<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function scopePublished(Builder $query)
    {
        return $query->where('published', 1);
    }

    public function author()
    {
        return $this->belongsTo('user', 'user_id');
    }
}
