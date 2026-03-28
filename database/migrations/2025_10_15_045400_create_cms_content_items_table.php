<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_content_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained('cms_contents')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            // New field

            $table->string('icon')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_content_items');
    }
};
