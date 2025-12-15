<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEprocurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('eprocurements');
        
        Schema::create('eprocurements', function (Blueprint $table) {
            $table->increments('id');
            
            // Corporate Identity
            $table->string('nama_perusahaan', 255);
            $table->string('nomor_sk_menkumham', 100);
            $table->string('no_akta', 100);
            $table->string('nomor_nib_oss', 100);
            $table->string('npwp', 100);
            $table->string('izin_operasional', 255);
            $table->string('nomor_telpon', 50);
            $table->string('email', 255);
            $table->string('website', 255)->nullable();
            
            // Direksi & Komisaris Identity
            $table->string('nama_direksi', 255)->nullable();
            $table->string('nama_komisaris', 255)->nullable();
            $table->string('ktp_direksi', 50)->nullable();
            $table->string('ktp_komisaris', 50)->nullable();
            $table->string('npwp_direksi', 155)->nullable();
            $table->string('npwp_komisaris', 155)->nullable();

            $table->string('hp_direksi', 15)->nullable();
            $table->string('hp_komisaris', 15)->nullable();
            
            // Financial Data
            $table->string('nomor_rekening', 100)->nullable();
            $table->string('nama_bank', 100)->nullable();
            $table->string('cabang_bank', 100)->nullable();
            $table->string('atas_nama', 255)->nullable();
            
            // File Uploads
            $table->string('sk_menkumham_file', 255)->nullable();
            $table->string('akta_file', 255)->nullable();
            $table->string('npwp_file', 255)->nullable();
            $table->string('nib_oss_file', 255)->nullable();
            $table->string('siup_file', 255)->nullable();
            $table->string('rekening_koran_file', 255)->nullable();
            $table->string('neraca_file', 255)->nullable();
            $table->string('company_profile_file', 255)->nullable();
            $table->string('portfolio_file', 255)->nullable();
            $table->string('cv_tenaga_ahli_file', 255)->nullable();
            $table->string('ktp_direksi_file', 255)->nullable();
            $table->string('ktp_komisaris_file', 255)->nullable();
            $table->string('npwp_direksi_file', 255)->nullable();
            $table->string('npwp_komisaris_file', 255)->nullable();
            
            // Status and Metadata
            $table->string('status', 15)->nullable();
            $table->string('source_data_eproc', 35)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eprocurements');
    }
} 