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
        Schema::create('prospektive_tenants', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('tenant');
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->double('booking_fee');
            // $table->string('lok_kav_book');
            $table->enum('evidence', ["Surat Minat", "Berita Acara Kesepatakan", "Lainnya"]);
            $table->enum('kategori', ["Cold", "Warm", "Hot"]);
            $table->enum('status', ["Penjajakan Awal", "Perjanjian Pendahuluan", "FS", "Deal Kontrak"]);
            $table->timestamp('kontrak_date');
            $table->double("kontrak_nilai_rencana");
            $table->integer('id_kavling')->nullable();
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
        Schema::dropIfExists('prospektive_tenants');
    }
};
