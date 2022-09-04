<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('id_villages', static function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('district_id')
                ->constrained('id_districts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('name', 50);
        });
    }

    public function down(): void
    {
        Schema::drop('villages');
    }
};
