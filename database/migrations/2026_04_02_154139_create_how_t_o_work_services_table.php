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
        Schema::create('how_t_o_work_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('core_service_id')->constrained('core_services')->nullOnDelete();
            $table->string('how_to_work_title')->nullable();
            $table->string('how_to_work_sub_title')->nullable();
            $table->string('how_to_work_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_t_o_work_services');
    }
};
