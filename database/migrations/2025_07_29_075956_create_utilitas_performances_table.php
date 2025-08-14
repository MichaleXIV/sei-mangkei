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
        Schema::create('utilitas_performances', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('bulan');
            $table->string('tahun');
            $table->enum('jenis_utilitas', ["listrik", "air_bersih", "limbah_cair", "jasa_lain", "tank_farm", "dry_port"]);
            $table->enum('sumber_energi', ["pln", "plts", "pltbg", "wwtp_tahap_i", "wwtp_tahap_ii", "wtp_tahap_i", "wtp_tahap_ii", "wtp_tahap_iii"]);
            $table->double('penjualan_kuantitas');
            $table->enum('satuan', ["kwh", "m3", "m2"]);
            $table->double('pendapatan');
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
        Schema::dropIfExists('utilitas_performances');
    }
};
