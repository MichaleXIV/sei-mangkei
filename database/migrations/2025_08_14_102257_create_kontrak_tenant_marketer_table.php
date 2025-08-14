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
        Schema::create('kontrak_tenant_marketer', function (Blueprint $table) {
            $table->unsignedBigInteger('kontrak_tenant_id');
            $table->unsignedBigInteger('marketer_id');

            $table->foreign('kontrak_tenant_id')->references('id')->on('kontrak_tenants')->onDelete('cascade');
            $table->foreign('marketer_id')->references('id')->on('marketers')->onDelete('cascade');

            $table->primary(['kontrak_tenant_id', 'marketer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_tenant_marketer');
    }
};
