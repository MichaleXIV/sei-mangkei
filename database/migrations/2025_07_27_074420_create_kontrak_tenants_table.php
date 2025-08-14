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
            $table->foreignId('tenant_id')->constrained()->onDelete("cascade");

            $table->double('luas');
            // $table->string('lok_kav');

            // $table->string("no_bk");
            // $table->foreignId("kavling_id")->constrained()->onDelete("cascade");

            // $table->enum('marketer', ["internal_kinra", "marketing_agency"]);
            // $table->string("marketer");
            // $table->foreignId("marketer_id")->constrained()->onDelete("cascade");

            $table->enum('jenis_tenant', ["Tenant Baru", "Ekspansi"]);
            $table->enum('skema', ["Blocksales", "Retail"]);
            $table->string('jenis_industri');
            $table->enum('sumber_modal', ["Penanaman Modal Asing", "Penanaman Modal Dalam Negeri"]);
            $table->string('negara_asal');
            $table->enum('insentif', ["Tax Holiday", "Tax Allowance"]);
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
            $table->enum('kavling_jenis', ["Kavling Mentahan", "Kavling Siap Bangun"]);
            $table->enum('status', ["HGB", "Hak Tanggung"]);
            $table->timestamp('created_date')->nullable();
            $table->string('created_user')->nullable();
            $table->timestamp('last_edited_date')->nullable();
            $table->string('last_edited_user')->nullable();
            $table->timestamps();

            $table->string("attachment")->nullable();
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
