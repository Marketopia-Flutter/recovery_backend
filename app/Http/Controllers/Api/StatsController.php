<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatsController extends Controller
{
    /**
     * Get user statistics
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Get last 7 days mood data
        $chartData = $user->moodTrackers()
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($mood) {
                return [
                    'date' => $mood->created_at->format('Y-m-d'),
                    'mood_level' => $mood->mood_level,
                ];
            });

        // Calculate longest streak
        $longestStreak = $user->getLongestStreak();

        // Get all badges with earned status
        $allBadges = Badge::orderBy('days_required', 'asc')->get();
        $currentStreak = $user->streak_days;

        $nextBadgeFound = false;
        $badges = $allBadges->map(function ($badge) use ($currentStreak, &$nextBadgeFound) {
            $isEarned = $currentStreak >= $badge->days_required;
            $status = 'locked';

            if ($isEarned) {
                $status = 'earned';
            } elseif (!$nextBadgeFound) {
                $status = 'pending';
                $nextBadgeFound = true;
            }

            return [
                'id' => $badge->id,
                'name' => $badge->name,
                'icon_url' => asset('storage/' . $badge->icon_path),
                'days_required' => $badge->days_required,
                'status' => $status,
                'is_earned' => $isEarned,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'chart_data' => $chartData,
                'longest_streak' => $longestStreak,
                'current_streak' => $currentStreak,
                'next_milestone' => $allBadges->where('days_required', '>', $currentStreak)->first()?->days_required,
                'badges' => $badges,
            ],
        ]);
    }
}
