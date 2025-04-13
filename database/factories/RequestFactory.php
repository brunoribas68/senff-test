<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Request;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    protected $model = Request::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::factory(),
            'requester_name' => $this->faker->name(),
            'status_id' => Status::factory(),
        ];
    }
}
