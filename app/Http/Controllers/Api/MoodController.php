<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MoodTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoodController extends Controller
{
    /**
     * Store mood tracker entry
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mood_level' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $mood = MoodTracker::create([
            'user_id' => $user->id,
            'mood_level' => $request->mood_level,
            'note' => $request->note,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mood logged successfully',
            'data' => $mood,
        ], 201);
    }
}
