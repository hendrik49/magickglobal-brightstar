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
        Schema::create('premi_bpjs_ketenagakerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('premi', 5, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('bpjs_employment_premiums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premi_bpjs_ketenagakerjaan_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('policy_number');
            $table->decimal('company_percentage', 5, 2);
            $table->decimal('employee_percentage', 5, 2);
            $table->timestamps();
        });

        Schema::create('insurance_medicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('provider'); // bpjs kesehatan, allianz, generali
            $table->string('policy_number');
            $table->decimal('nominal', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpjs_settings');
        Schema::dropIfExists('employee_bpjs');
    }
};
