<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'الخطوة الأولى',
                'icon_path' => 'badges/3-days.svg',
                'days_required' => 3,
            ],
            [
                'name' => '٧ أيام',
                'icon_path' => 'badges/7-days.svg',
                'days_required' => 7,
            ],
            [
                'name' => 'شهر واحد',
                'icon_path' => 'badges/30-days.svg',
                'days_required' => 30,
            ],
            [
                'name' => 'سيد رزين',
                'icon_path' => 'badges/60-days.svg',
                'days_required' => 60,
            ],
            [
                'name' => 'ثلاث أشهر',
                'icon_path' => 'badges/90-days.svg',
                'days_required' => 90,
            ],
            [
                'name' => 'ملك',
                'icon_path' => 'badges/365-days.svg',
                'days_required' => 365,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(
                ['days_required' => $badge['days_required']],
                $badge
            );
        }
    }
}
