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
        Schema::create('kavlings', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('metadata')->nullable();
            $table->string('remark')->nullable();
            $table->string('srs_id')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('gisid')->nullable();
            $table->string('bk');
            $table->string('no_bk')->unique();
            $table->double('luas_kav');
            $table->string('lok_kav');
            $table->string('jenis_kav');
            $table->double('shape_lenght')->nullable();
            $table->string('geometry')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('created_user')->nullable();
            $table->timestamp('last_edited_date')->nullable();
            $table->string('last_edited_user')->nullable();
            $table->string('luas_kawasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('kontrak_tenant_id')->nullable();
            $table->foreign('kontrak_tenant_id')
                ->references('id')
                ->on('kontrak_tenants')
                ->nullOnDelete();
            $table->unsignedBigInteger('prospektive_tenant_id')->nullable();
            $table->foreign('prospektive_tenant_id')
                ->references('id')
                ->on('prospektive_tenants')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kavlings');
    }
};
