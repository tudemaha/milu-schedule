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
        Schema::create('master_teams', function (Blueprint $table) {
            $table->tinyInteger('id')->primary();
            $table->string('name');
        });

        Schema::create('master_request_types', function (Blueprint $table) {
            $table->tinyInteger('id')->primary();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_teams');
        Schema::dropIfExists('master_request_types');
    }
};
