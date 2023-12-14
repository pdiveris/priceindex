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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->nullable(false);

            $table->text('description')
                ->nullable(true);

            $table->text('media')
                ->default('')
                ->comment('Images and other media associated with the category')
                ->nullable(true);

            $table->tinyInteger('enabled')
                ->default(1)
                ->nullable(true);

            $table->timestamps();

            $table->dateTime('deleted_at')
                ->nullable(true);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
