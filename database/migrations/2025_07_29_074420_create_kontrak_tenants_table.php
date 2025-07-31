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
        Schema::create('kontrak_tenants', function (Blueprint $table) {
            $table->id();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('tenant');
            $table->double('luas');
            $table->string('lok_kav');
            $table->enum('marketer', ["internal_kinra", "marketing_agency"]);
            $table->enum('jenis_tenant', ["prospective_tenant", "tenant_baru", "ekspansi"]);
            $table->enum('skema', ["blocksales", "retail"]);
            $table->string('jenis_industri');
            $table->enum('sumber_modal', ["penanaman_modal_asing", "penanaman_modal_dalam_negeri"]);
            $table->string('negara_asal');
            $table->enum('insentif', ["tax_holiday", "tax_allowance"]);
            $table->string('produksi');
            $table->string('kapasitas_produksi');
            $table->string('kontrak');
            $table->timestamp('kontrak_date');
            $table->timestamp('end_date');
            $table->double('kontrak_nilai');
            $table->double('harga_m');
            $table->double('nilai_accrual');
            $table->string('no_perjanjian');
            $table->double('kavling_harga');
            $table->date('date_ppl');
            $table->enum('kavling_jenis', ["kavling_mentahan", "kavling_siap_bangun"]);
            $table->enum('status', ["hgb", "hak_tanggung"]);
            $table->integer('id_kavling')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('created_user')->nullable();
            $table->timestamp('last_edited_date')->nullable();
            $table->string('last_edited_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_tenants');
    }
};
