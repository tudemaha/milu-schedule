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
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('staff_id');
            $table->tinyInteger('request_id');
            $table->date('date');
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staffs');
            $table->foreign('request_id')->references('id')->on('master_request_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
