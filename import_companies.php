<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// قراءة ملف JSON
$jsonFile = $argv[1] ?? 'companies.json';
if (!file_exists($jsonFile)) {
    echo "❌ الملف غير موجود: {$jsonFile}\n";
    exit(1);
}

$jsonContent = file_get_contents($jsonFile);
$data = json_decode($jsonContent, true);

// استخراج بيانات الشركات
$companies = [];
foreach ($data as $item) {
    if (isset($item['type']) && $item['type'] === 'table' && $item['name'] === 'companies') {
        $companies = $item['data'];
        break;
    }
}

if (empty($companies)) {
    echo "❌ لم يتم العثور على بيانات الشركات في الملف\n";
    exit(1);
}

echo "📊 تم العثور على " . count($companies) . " شركة\n";
echo "🚀 بدء عملية الاستيراد...\n\n";

// تعريف الأقسام والدول
$categoryMapping = [
    'G_ecommerce' => ['name_ar' => 'التجارة الإلكترونية', 'name_en' => 'E-commerce'],
    'Q_healthcare' => ['name_ar' => 'الرعاية الصحية', 'name_en' => 'Healthcare'],
    'M_services' => ['name_ar' => 'الخدمات', 'name_en' => 'Services'],
    'C_manufacturing' => ['name_ar' => 'التصنيع', 'name_en' => 'Manufacturing'],
    'J_technology' => ['name_ar' => 'التكنولوجيا', 'name_en' => 'Technology'],
    'C_machinery' => ['name_ar' => 'الآلات', 'name_en' => 'Machinery'],
    'G_automotive_repair' => ['name_ar' => 'إصلاح السيارات', 'name_en' => 'Automotive Repair'],
    'C_electronics' => ['name_ar' => 'الإلكترونيات', 'name_en' => 'Electronics'],
    'C_manufacturing_general' => ['name_ar' => 'التصنيع العام', 'name_en' => 'General Manufacturing'],
    'D_energy' => ['name_ar' => 'الطاقة', 'name_en' => 'Energy'],
    'E_utilities' => ['name_ar' => 'المرافق', 'name_en' => 'Utilities'],
    'G_retail' => ['name_ar' => 'التجزئة', 'name_en' => 'Retail'],
];

$countryMapping = [
    'LY' => ['name_ar' => 'ليبيا', 'name_en' => 'Libya'],
    'EG' => ['name_ar' => 'مصر', 'name_en' => 'Egypt'],
    'CN' => ['name_ar' => 'الصين', 'name_en' => 'China'],
    'TR' => ['name_ar' => 'تركيا', 'name_en' => 'Turkey'],
];

$stats = [
    'success' => 0,
    'failed' => 0,
    'categories_added' => 0,
    'countries_added' => 0,
    'images_copied' => 0,
    'images_missing' => 0,
];

// معالجة كل شركة
foreach ($companies as $company) {
    try {
        DB::beginTransaction();

        // 1. إضافة أو جلب القسم
        $categoryCode = $company['category'];
        if (!isset($categoryMapping[$categoryCode])) {
            echo "⚠️  القسم غير معروف: {$categoryCode} للشركة {$company['company_name']}\n";
            $categoryMapping[$categoryCode] = [
                'name_ar' => $categoryCode,
                'name_en' => $categoryCode
            ];
        }

        $category = DB::table('categories')->where('name_en', $categoryMapping[$categoryCode]['name_en'])->first();
        if (!$category) {
            $categoryId = DB::table('categories')->insertGetId([
                'name_ar' => $categoryMapping[$categoryCode]['name_ar'],
                'name_en' => $categoryMapping[$categoryCode]['name_en'],
                'logo' => null,
                'sort' => 0,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "✅ تم إضافة قسم جديد: {$categoryMapping[$categoryCode]['name_ar']}\n";
            $stats['categories_added']++;
        } else {
            $categoryId = $category->id;
        }

        // 2. إضافة أو جلب الدولة
        $countryCode = $company['country_code'];
        if (!isset($countryMapping[$countryCode])) {
            echo "⚠️  الدولة غير معروفة: {$countryCode} للشركة {$company['company_name']}\n";
            $countryMapping[$countryCode] = [
                'name_ar' => $company['country'],
                'name_en' => $company['country']
            ];
        }

        $country = DB::table('countries')->where('code', $countryCode)->first();
        if (!$country) {
            $countryId = DB::table('countries')->insertGetId([
                'name_ar' => $countryMapping[$countryCode]['name_ar'],
                'name_en' => $countryMapping[$countryCode]['name_en'],
                'code' => $countryCode,
                'sort' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "✅ تم إضافة دولة جديدة: {$countryMapping[$countryCode]['name_ar']}\n";
            $stats['countries_added']++;
        } else {
            $countryId = $country->id;
        }

        // 3. التحقق من وجود المستخدم
        $email = $company['contact_email'];
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            // إنشاء مستخدم جديد
            $userId = DB::table('users')->insertGetId([
                'name' => $company['company_name'],
                'email' => $email,
                'type' => 'company_profile',
                'status' => 'accepted', // حساب مفعل
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $user->id;
        }

        // 4. معالجة الشعار
        $logoPath = null;
        if (!empty($company['logo'])) {
            // إنشاء المجلد إذا لم يكن موجوداً
            $logoDir = __DIR__ . '/public/storage/company-logos';
            if (!is_dir($logoDir)) {
                mkdir($logoDir, 0755, true);
            }

            // حفظ المسار في قاعدة البيانات مباشرة
            $logoPath = 'company-logos/' . $company['logo'];

            // التحقق من وجود الصورة بالاسم الأصلي
            $originalImagePath = $logoDir . '/' . $company['logo'];

            if (file_exists($originalImagePath)) {
                $stats['images_copied']++;
                echo "   ✅ الصورة موجودة: {$company['logo']}\n";
            } else {
                // البحث عن الصورة بامتدادات مختلفة
                $baseFileName = pathinfo($company['logo'], PATHINFO_FILENAME);
                $possibleExtensions = ['png', 'jpg', 'jpeg', 'webp', 'gif', 'svg'];
                $imageFound = false;

                foreach ($possibleExtensions as $ext) {
                    $testPath = $logoDir . '/' . $baseFileName . '.' . $ext;
                    if (file_exists($testPath)) {
                        $logoPath = 'company-logos/' . $baseFileName . '.' . $ext;
                        $stats['images_copied']++;
                        $imageFound = true;
                        echo "   ✅ الصورة موجودة بامتداد مختلف: {$baseFileName}.{$ext}\n";
                        break;
                    }
                }

                if (!$imageFound) {
                    $stats['images_missing']++;
                    echo "   ⚠️  الصورة سيتم إضافتها لاحقاً: {$company['logo']}\n";
                }
            }
        }

        // 5. تحديد اسم الشركة بالعربي والإنجليزي
        $companyName = $company['company_name'];
        $language = $company['language'];

        // إذا كانت اللغة عربية، الاسم العربي هو الأساسي
        if ($language === 'arabic') {
            $nameAr = $companyName;
            $nameEn = $companyName; // نفس الاسم للإنجليزي
        } else {
            $nameEn = $companyName;
            $nameAr = $companyName; // نفس الاسم للعربي
        }

        // 6. إضافة الشركة
        $companyId = DB::table('companies')->insertGetId([
            'user_id' => $userId,
            'category_id' => $categoryId,
            'name_ar' => $nameAr,
            'name_en' => $nameEn,
            'language' => $language,
            'logo' => $logoPath,
            'website_url' => $company['website'] ?? null,
            'contact_email' => $email,
            'preferred_contact_method' => $company['contact_method'] ?? null,
            'description_ar' => $company['description'],
            'description_en' => $company['description'],
            'is_visible' => true,
            'status' => 'accepted', // شركة مفعلة
            'sort' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 7. ربط الشركة بالدولة
        DB::table('company_country')->insert([
            'company_id' => $companyId,
            'country_id' => $countryId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::commit();

        echo "✅ تم إضافة الشركة: {$company['company_name']}\n";
        $stats['success']++;

    } catch (Exception $e) {
        DB::rollBack();
        echo "❌ فشل إضافة الشركة: {$company['company_name']}\n";
        echo "   السبب: {$e->getMessage()}\n";
        $stats['failed']++;
    }
}

// عرض الإحصائيات
echo "\n" . str_repeat('=', 50) . "\n";
echo "📊 ملخص عملية الاستيراد:\n";
echo str_repeat('=', 50) . "\n";
echo "✅ نجح: {$stats['success']} شركة\n";
echo "❌ فشل: {$stats['failed']} شركة\n";
echo "📁 أقسام جديدة: {$stats['categories_added']}\n";
echo "🌍 دول جديدة: {$stats['countries_added']}\n";
echo "📸 صور تم نسخها: {$stats['images_copied']}\n";
echo "⚠️  صور مفقودة: {$stats['images_missing']}\n";
echo str_repeat('=', 50) . "\n";
