<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('section');
            $table->string('main_title')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('background_image')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['page', 'section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_contents');
    }
};
