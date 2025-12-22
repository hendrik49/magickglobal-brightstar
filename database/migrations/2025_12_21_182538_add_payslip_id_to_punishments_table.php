<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('punishments', function (Blueprint $table) {
            $table->unsignedBigInteger('payslip_id')
                  ->nullable()
                  ->after('employee_id');

            // OPTIONAL tapi sangat disarankan (FK)
            $table->foreign('payslip_id')
                  ->references('id')
                  ->on('pay_slips')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('punishments', function (Blueprint $table) {
            $table->dropForeign(['payslip_id']);
            $table->dropColumn('payslip_id');
        });
    }
};
