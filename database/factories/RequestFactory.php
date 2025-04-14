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
            'category_id' => $categories->isNotEmpty() ? $categories->random()->id : Category::factory(),
            'requester_name' => $this->faker->name(),
            'status_id' => $statuses->isNotEmpty() ? $statuses->random()->id : Status::factory(),
        ];
    }

    /**
     * Define um estado para uma categoria específica.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withCategory(Category $category)
    {
        return $this->state(fn () => [
            'category_id' => $category->id,
        ]);
    }

    /**
     * Define um estado para um status específico.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withStatus(Status $status)
    {
        return $this->state(fn () => [
            'status_id' => $status->id,
        ]);
    }
}
