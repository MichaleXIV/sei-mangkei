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
        Schema::create('rkaps', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->double('pemasaran_rp');
            $table->double('pemasaran_ha');
            $table->double('air_bersih_rp');
            $table->double('air_bersih_m3');
            $table->double('limbah_cair_rp');
            $table->double('limbah_cair_m3');
            $table->double('listrik_rp');
            $table->double('listrik_kwh');
            $table->double('investasi');
            $table->string('tahun_rkap');
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
        Schema::dropIfExists('rkaps');
    }
};
