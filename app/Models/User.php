<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        'avatar',
        'clean_date',
        'fcm_token',
        'is_guest',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'clean_date' => 'datetime',
            'is_guest' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    // Check if user is company profile
    public function isCompanyProfile(): bool
    {
        return $this->type === 'company_profile';
    }

    // Check if user is accepted
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    // Relationship with company
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    // Recovery App Relationships
    public function relapses()
    {
        return $this->hasMany(Relapse::class);
    }

    public function moodTrackers()
    {
        return $this->hasMany(MoodTracker::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->withTimestamps()
                    ->withPivot('earned_at');
    }

    // Recovery App Methods
    public function getStreakDaysAttribute(): int
    {
        if (!$this->clean_date) {
            return 0;
        }

        return (int) $this->clean_date->startOfDay()->diffInDays(now()->startOfDay());
    }

    public function getCurrentBadge()
    {
        return $this->badges()->orderBy('days_required', 'desc')->first();
    }

    public function getNextMilestone()
    {
        $currentStreak = $this->streak_days;
        $nextBadge = Badge::where('days_required', '>', $currentStreak)
                         ->orderBy('days_required', 'asc')
                         ->first();
        
        if (!$nextBadge) {
            return null;
        }

        return [
            'badge' => $nextBadge,
            'days_remaining' => $nextBadge->days_required - $currentStreak,
        ];
    }

    public function getLongestStreak(): int
    {
        $relapses = $this->relapses()->orderBy('relapse_date', 'asc')->get();
        
        if ($relapses->isEmpty()) {
            return $this->streak_days;
        }

        // Find the maximum streak from all stored relapse records
        $longestStreak = $relapses->max('streak_days') ?? 0;

        // Compare with current streak
        $currentStreak = $this->streak_days;
        $longestStreak = max($longestStreak, $currentStreak);

        return $longestStreak;
    }

    // Filament Admin Panel Access Control
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->is_admin;
    }

    // JWT Methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
