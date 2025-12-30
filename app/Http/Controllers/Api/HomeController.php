<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Badge;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get home dashboard data
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Calculate streak days
        $streakDays = $user->streak_days;

        // Get current badge (highest earned)
        $currentBadge = $user->getCurrentBadge();

        // Get next milestone
        $nextMilestone = $user->getNextMilestone();

        // Get random daily quote
        $dailyQuote = Quote::inRandomOrder()->first();

        // Get active banners
        $banners = \App\Models\Banner::where('is_active', true)->get();

        // Check and assign new badges
        $this->checkAndAssignBadges($user, $streakDays);

        return response()->json([
            'success' => true,
            'data' => [
                'streak_days' => $streakDays,
                'current_badge' => $currentBadge,
                'next_milestone' => $nextMilestone,
                'daily_quote' => $dailyQuote,
                'banners' => $banners,
            ],
        ]);
    }

    /**
     * Check and assign badges to user
     */
    private function checkAndAssignBadges($user, $streakDays)
    {
        // Get badges user should have earned
        $earnedBadgeIds = $user->badges()->pluck('badges.id')->toArray();
        
        $newBadges = Badge::where('days_required', '<=', $streakDays)
            ->whereNotIn('id', $earnedBadgeIds)
            ->get();

        foreach ($newBadges as $badge) {
            $user->badges()->attach($badge->id, ['earned_at' => now()]);
        }
    }
}
