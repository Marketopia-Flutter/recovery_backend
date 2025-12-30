<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relapse extends Model
{
    protected $fillable = [
        'user_id',
        'relapse_date',
        'trigger_cause',
        'notes',
        'streak_days',
    ];

    protected function casts(): array
    {
        return [
            'relapse_date' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
