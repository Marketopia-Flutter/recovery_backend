<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // معلومات الاتصال
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();

            // وصف علي ديبو
            $table->text('about_ar')->nullable();
            $table->text('about_en')->nullable();

            // الصفحات القانونية
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_conditions')->nullable();

            // روابط التطبيقات
            $table->string('android_version')->nullable();
            $table->string('ios_version')->nullable();
            $table->string('android_link')->nullable();
            $table->string('ios_link')->nullable();

            // روابط التواصل الاجتماعي
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
