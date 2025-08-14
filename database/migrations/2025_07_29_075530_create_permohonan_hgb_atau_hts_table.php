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
        Schema::create('permohonan_hgb_atau_hts', function (Blueprint $table) {
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
            $table->string('kontrak_nilai');
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
        Schema::dropIfExists('permohonan_hgb_atau_hts');
    }
};
