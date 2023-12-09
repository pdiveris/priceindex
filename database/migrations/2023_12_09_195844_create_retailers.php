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
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('enabled')
                ->default(1)
                ->nullable(false);

            $table->string('name')
                ->default('')
                ->nullable(false);

            $table->string('class')
                ->default('')
                ->nullable(true);

            $table->string('logo')
                ->default('')
                ->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailers');
    }
};
