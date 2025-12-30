<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'خصم ٥٠٪ على الاستشارات',
                'subtitle' => 'احجز جلستك الأولى الآن',
                'image' => 'assets/images/banners/banner1.png',
                'is_active' => true,
            ],
            [
                'title' => 'انضم إلى مجتمعنا',
                'subtitle' => 'تواصل مع أشخاص يشاركونك نفس الرحلة',
                'image' => 'assets/images/banners/banner2.png',
                'is_active' => true,
            ],
            [
                'title' => 'نصيحة اليوم المقترحة',
                'subtitle' => 'كلما تعلقت بالأمل كلما زادت قوتك',
                'image' => 'assets/images/banners/banner3.png',
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
