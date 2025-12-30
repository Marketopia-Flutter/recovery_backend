<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Content;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'مقالات الدعم النفسي',
                'type' => 'article',
            ],
            [
                'name' => 'فيديوهات تحفيزية',
                'type' => 'video',
            ],
            [
                'name' => 'تمارين التأمل',
                'type' => 'audio',
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);

            // Add sample content for each category
            if ($category->type === 'article') {
                Content::create([
                    'category_id' => $category->id,
                    'title' => 'فهم رحلة التعافي',
                    'description' => 'دليل شامل لفهم عملية التعافي والخطوات الأساسية للنجاح',
                    'body' => '<p>التعافي هو رحلة مستمرة تتطلب الصبر والعزيمة...</p>',
                    'thumbnail' => 'thumbnails/article-1.jpg',
                    'is_featured' => true,
                ]);
            } elseif ($category->type === 'video') {
                Content::create([
                    'category_id' => $category->id,
                    'title' => 'قصص نجاح ملهمة',
                    'description' => 'استمع إلى قصص أشخاص تغلبوا على التحديات',
                    'media_url' => 'https://www.youtube.com/watch?v=example',
                    'thumbnail' => 'thumbnails/video-1.jpg',
                    'is_featured' => true,
                ]);
            } elseif ($category->type === 'audio') {
                Content::create([
                    'category_id' => $category->id,
                    'title' => 'تأمل للاسترخاء',
                    'description' => 'جلسة تأمل موجهة لمدة 10 دقائق',
                    'media_url' => 'audio/meditation-1.mp3',
                    'thumbnail' => 'thumbnails/audio-1.jpg',
                    'is_featured' => false,
                ]);
            }
        }
    }
}
