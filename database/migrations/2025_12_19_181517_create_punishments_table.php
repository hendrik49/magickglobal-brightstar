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
       Schema::create('punishments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('punishmentype'); // award / punishment
            $table->date('date')->nullable();
            $table->integer('gift')->nullable(); // poin / deduksi
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punishments');
    }
};
