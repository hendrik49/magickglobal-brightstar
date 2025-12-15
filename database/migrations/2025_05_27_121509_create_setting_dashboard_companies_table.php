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
        Schema::create('setting_dashboard_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('background_manufacture')->nullable();
            $table->string('icon_manufacture')->nullable();
            $table->string('background_pertambangan')->nullable();
            $table->string('icon_pertambangan')->nullable();
            $table->string('background_koperasi')->nullable();
            $table->string('icon_koperasi')->nullable();
            $table->string('background_pertanian')->nullable();
            $table->string('icon_pertanian')->nullable();
            $table->string('background_ekspedisi')->nullable();
            $table->string('icon_ekspedisi')->nullable();
            $table->string('background_ritel')->nullable();
            $table->string('icon_ritel')->nullable();
            $table->string('background_pelanggan')->nullable();
            $table->string('icon_pelanggan')->nullable();
            $table->string('background_vendor')->nullable();
            $table->string('icon_vendor')->nullable();
            $table->string('background_invoice')->nullable();
            $table->string('icon_invoice')->nullable();
            $table->string('background_bill')->nullable();
            $table->string('icon_bill')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_dashboard_companies');
    }
};
