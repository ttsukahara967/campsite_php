<?php

namespace Database\Factories;

use App\Models\Campsite;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampsiteFactory extends Factory
{
    protected $model = Campsite::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word() . 'キャンプ場',
            'address' => $this->faker->address(),
            'description' => $this->faker->realText(50),
            'facilities' => 'トイレ, シャワー',
            'price' => $this->faker->numberBetween(500, 5000),
            'image_url' => $this->faker->imageUrl(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}

