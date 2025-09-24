<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->name(),
            'retailer_id' => $this->faker->randomNumber(),
            'country_code' => $this->faker->word(),
            'unit_id' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomFloat(),
            'price' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
