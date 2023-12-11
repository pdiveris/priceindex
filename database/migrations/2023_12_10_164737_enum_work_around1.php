<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('unit')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            DB::statement(
                "ALTER TABLE `products` MODIFY COLUMN `unit`
                        enum('weight',
                        'quantity',
                        'KWh'
                        )
                    NOT NULL AFTER `category`;
                "
            );
        });
    }
};
