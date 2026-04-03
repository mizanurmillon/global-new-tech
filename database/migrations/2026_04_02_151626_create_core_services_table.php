<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('core_services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('hero_title')->nullable();
            $table->string('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            // Main service section title & subtitle
            $table->string('main_section_title')->nullable();
            $table->string('main_section_subtitle')->nullable();

            // Service section
            $table->string('service_title')->nullable();
            $table->string('service_subtitle')->nullable();
            $table->longText('service_description')->nullable();
            $table->string('service_icon')->nullable();

            // Work section title & subtitle
            $table->string('work_section_title')->nullable();
            $table->string('work_section_subtitle')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_services');
    }
};
