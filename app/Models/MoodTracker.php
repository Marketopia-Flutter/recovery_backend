<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodTracker extends Model
{
    protected $fillable = [
        'user_id',
        'mood_level',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'mood_level' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
