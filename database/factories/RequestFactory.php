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
        $statuses = Status::all();
        $categories = Category::all();

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'category_id' => $categories[rand(1, 2)]->id,
            'requester_name' => $this->faker->name(),
            'status_id' => $statuses[rand(0, 2)]->id,
        ];
    }
}
