<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MoodTracker;
use Carbon\Carbon;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Create data for the last 10 days
            for ($i = 10; $i >= 0; $i--) {
                MoodTracker::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'created_at' => Carbon::now()->subDays($i)->startOfDay(),
                    ],
                    [
                        'mood_level' => rand(1, 5), // Random mood from 1 to 5
                        'note' => 'طاقة إيجابية اليوم، مستمر في التعافي.',
                        'updated_at' => Carbon::now()->subDays($i)->startOfDay(),
                    ]
                );
            }
        }
    }
}
