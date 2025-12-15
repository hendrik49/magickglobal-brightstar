<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incoming_mails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_no',50);
            $table->date('date');
            $table->string('source');
            $table->string('subject');
            $table->char('status', 1);
            $table->unsignedBigInteger('created_by')->default(0);
            $table->timestamps();
        });

        Schema::create('outgoing_mails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_no',50);
            $table->date('date');
            $table->string('destination');
            $table->string('subject');
            $table->char('status', 1);
            $table->unsignedBigInteger('created_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS incoming_mails');
        DB::statement('DROP TABLE IF EXISTS outgoing_mails');
    }
};
