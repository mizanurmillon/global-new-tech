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
        Schema::create('sub_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('core_service_id')->constrained('core_services')->cascadeOnDelete();
            $table->string('sub_service_title')->nullable();
            $table->string('sub_service_sub_title')->nullable();
            $table->longText('sub_service_description')->nullable();
            $table->string('sub_service_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_services');
    }
};
