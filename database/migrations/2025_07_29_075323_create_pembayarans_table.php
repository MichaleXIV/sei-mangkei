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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('tenant');
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('kontrak');
            $table->timestamp('kontrak_date');
            $table->double('masa_sewa');
            $table->double("investasi");
            $table->string('kontrak_nilai');
            $table->string('pembayaran_termin');
            $table->double('nilai');
            $table->string('persentase');
            $table->date('date');
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
        Schema::dropIfExists('pembayarans');
    }
};
