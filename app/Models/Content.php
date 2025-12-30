<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'body',
        'media_url',
        'thumbnail',
        'is_featured',
    ];

    protected $appends = ['full_media_url', 'full_thumbnail_url'];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessors for API
    public function getFullMediaUrlAttribute()
    {
        $value = $this->media_url;
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    public function getFullThumbnailUrlAttribute()
    {
        $value = $this->thumbnail;
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
