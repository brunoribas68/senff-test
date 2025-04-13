<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Request;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_request()
    {
        // Arrange
        $category = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'open']);

        // Act
        $request = Request::create([
            'title' => 'Teste de Solicitação',
            'description' => 'Descrição da solicitação',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => $status->id,
        ]);

        // Assert
        $this->assertDatabaseHas('requests', [
            'title' => 'Teste de Solicitação',
            'description' => 'Descrição da solicitação',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => $status->id,
        ]);
    }

    public function test_it_updates_request_status()
    {
        // Arrange
        $category = Category::factory()->create();
        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusClosed = Status::factory()->create(['name' => 'closed']);

        $request = Request::factory()->create([
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'requester_name' => 'Fulano',
        ]);

        // Act
        $request->update(['status_id' => $statusClosed->id]);

        // Assert
        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusClosed->id,
        ]);
    }
}
