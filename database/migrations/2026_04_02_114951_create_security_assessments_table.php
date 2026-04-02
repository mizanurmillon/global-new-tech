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
        Schema::create('security_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->text('company_name')->nullable();
            $table->string('security_interest')->nullable();
            $table->string('company_size')->nullable();
            $table->string('timeline')->nullable();
            $table->string('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_assessments');
    }
};
