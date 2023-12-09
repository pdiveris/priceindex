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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('enabled')->default(0)->nullable(false);

            $table->string('name', 80);
            $table->string('alpha_2', 2);
            $table->string('alpha_3', 3);

            $table->string('country_code', 20);
            $table->string('iso_3166_2', 60);
            $table->string('region', 60);
            $table->string('sub_region', 60);
            $table->string('intermediate_region', 60);
            $table->string('region_code', 20);
            $table->string('sub_region_code', 20);
            $table->string('intermediate_region_code', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
