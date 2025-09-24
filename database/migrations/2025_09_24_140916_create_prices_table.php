<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('prices');

        Schema::create('prices', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');

            $table->bigInteger('retailer_id')
                ->unsigned();

            $table->foreign('retailer_id')
                ->references('id')
                ->on('retailers')
                ->onDelete('cascade');

            $table->string('country_code');
            $table->foreign('country_code')
                ->references('alpha_2')
                ->on('countries')
                ->onDelete('cascade');

            $table->bigInteger('unit_id')
                ->unsigned();

            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('cascade');

            $table->decimal('quantity')
                ->unsigned();

            $table->decimal('price')
                ->unsigned();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
