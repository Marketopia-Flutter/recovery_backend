<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'days_required',
    ];

    protected function casts(): array
    {
        return [
            'days_required' => 'integer',
        ];
    }

    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
                    ->withTimestamps()
                    ->withPivot('earned_at');
    }
}
