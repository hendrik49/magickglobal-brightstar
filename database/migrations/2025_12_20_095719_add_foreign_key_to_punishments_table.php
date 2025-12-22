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
        Schema::table('punishments', function (Blueprint $table) {
            //
            Schema::table('punishments', function (Blueprint $table) {
            table->foreign('employee_id')
          ->references('id')
          ->on('employees')
          ->cascadeOnDelete();
});
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('punishments', function (Blueprint $table) {
            //
        });
    }
};
