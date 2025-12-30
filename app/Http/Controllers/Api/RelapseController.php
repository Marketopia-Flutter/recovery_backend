<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Relapse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RelapseController extends Controller
{
    /**
     * Handle relapse (reset counter)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Get current streak before reset
        $currentStreak = $user->streak_days;

        // Create relapse record with the streak that's ending
        Relapse::create([
            'user_id' => $user->id,
            'relapse_date' => now(),
            'trigger_cause' => $request->reason,
            'notes' => $request->note,
            'streak_days' => $currentStreak, // Save the streak before reset
        ]);

        // Reset user's clean date
        $user->update([
            'clean_date' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Don\'t give up, new streak started.',
            'streak_days' => 0,
        ]);
    }
}
