<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Request;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_status_route_updates_request_status()
    {
        // Arrange
        $category = Category::factory()->create();
        $statusOld = Status::factory()->create(['name' => 'Pendente']);
        $statusNew = Status::factory()->create(['name' => 'Concluído']);

        $request = Request::factory()->create([
            'category_id' => $category->id,
            'status_id' => $statusOld->id,
            'requester_name' => 'Maria',
        ]);

        // Act
        $response = $this->put(route('requests.update-status', $request->id), [
            'status_id' => $statusNew->id,
        ]);
        // Assert
        $response->assertRedirect(route('requests.index'));
        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusNew->id,
        ]);
    }
}
