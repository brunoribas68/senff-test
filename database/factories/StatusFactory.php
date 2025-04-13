<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['open', 'in_progress', 'closed']),
            'description' => $this->faker->sentence(),
        ];
    }
}
