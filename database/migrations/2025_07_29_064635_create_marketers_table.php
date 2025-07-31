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
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('gisid')->nullable();
            $table->string("nama_agency");
            $table->string("alamat_tenant");
            $table->string("nomor_sertifikat_p4t");
            $table->string("email");
            $table->string("no_telp");
            $table->string("fax");
            $table->string("no_hp");
            $table->string("no_whatsapp");
            $table->string("npwp");
            $table->enum("jenis_marketer", ["internal", "external"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketers');
    }
};
