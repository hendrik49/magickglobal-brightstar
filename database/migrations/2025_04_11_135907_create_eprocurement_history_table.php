<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEprocurementHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('eprocurement_history');
        
        Schema::create('eprocurement_history', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('eprocurement_id');
            $table->string('status', 255)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('eprocurement_id')
                  ->references('id')
                  ->on('eprocurements')
                  ->onDelete('cascade');
                  
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eprocurement_history');
    }
} 