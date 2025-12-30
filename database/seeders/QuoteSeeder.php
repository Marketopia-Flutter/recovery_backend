<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            ['text' => 'كل يوم جديد هو فرصة للبدء من جديد', 'author' => null],
            ['text' => 'القوة ليست في عدم السقوط، بل في النهوض في كل مرة', 'author' => null],
            ['text' => 'التعافي رحلة، ليس وجهة', 'author' => null],
            ['text' => 'أنت أقوى مما تعتقد', 'author' => null],
            ['text' => 'لا تستسلم أبداً. الغد يحمل أملاً جديداً', 'author' => null],
            ['text' => 'كل خطوة صغيرة تقربك من هدفك', 'author' => null],
            ['text' => 'النجاح هو مجموع الجهود الصغيرة المتكررة يوماً بعد يوم', 'author' => null],
            ['text' => 'أنت لست وحدك في هذه الرحلة', 'author' => null],
            ['text' => 'الشجاعة ليست عدم الخوف، بل مواجهة الخوف رغم وجوده', 'author' => null],
            ['text' => 'الأيام الصعبة تصنع أشخاصاً أقوياء', 'author' => null],
            ['text' => 'التغيير يبدأ من داخلك', 'author' => null],
            ['text' => 'كل لحظة هي فرصة لاتخاذ القرار الصحيح', 'author' => null],
            ['text' => 'الماضي لا يحدد مستقبلك', 'author' => null],
            ['text' => 'آمن بنفسك وقدرتك على التعافي', 'author' => null],
            ['text' => 'التقدم قد يكون بطيئاً، لكنه يبقى تقدماً', 'author' => null],
            ['text' => 'لست مثالياً، وهذا أمر طبيعي', 'author' => null],
            ['text' => 'كل يوم تمضيه في التعافي هو انتصار', 'author' => null],
            ['text' => 'ركز على اليوم الحالي، لا تقلق بشأن الغد', 'author' => null],
            ['text' => 'الألم مؤقت، لكن الفخر بالإنجاز يدوم', 'author' => null],
            ['text' => 'أنت تستحق حياة أفضل', 'author' => null],
        ];

        foreach ($quotes as $quote) {
            Quote::create($quote);
        }
    }
}
