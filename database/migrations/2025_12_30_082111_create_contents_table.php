<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->longText('body')->nullable();
            $table->string('media_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->timestamps();
            
            $table->index(['category_id', 'is_featured']);
        });
        
        // Ensure UTF8mb4 charset for Arabic support
        DB::statement('ALTER TABLE contents CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
