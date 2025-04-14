<?php

namespace Tests\Unit;

use App\Http\Controllers\RequestController;
use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_it_updates_request_status()
    {
        $category = Category::factory()->create();
        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusClosed = Status::factory()->create(['name' => 'closed']);

        $request = UserRequest::factory()->create([
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'requester_name' => 'Fulano',
        ]);

        $request->update(['status_id' => $statusClosed->id]);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusClosed->id,
        ]);
    }

    public function test_store_creates_request()
    {
        $category = Category::factory()->create();

        $requestData = [
            'title' => 'Nova Solicitação',
            'description' => 'Descrição detalhada',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
        ];

        $request = new StoreRequest($requestData);

        $controller = new RequestController;
        $response = $controller->store($request);

        $this->assertEquals(route('requests.index'), $response->getTargetUrl());
        $this->assertEquals(302, $response->status());

        $this->assertDatabaseHas('requests', [
            'title' => 'Nova Solicitação',
            'description' => 'Descrição detalhada',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);
    }

    public function test_update_status_updates_request()
    {
        $category = Category::factory()->create();
        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusClosed = Status::factory()->create(['name' => 'closed']);

        $request = UserRequest::factory()->create([
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'requester_name' => 'Fulano',
        ]);

        $httpRequest = new \Illuminate\Http\Request([
            'status_id' => $statusClosed->id,
        ]);

        $controller = new RequestController;
        $response = $controller->updateStatus($request->id, $httpRequest);

        $this->assertEquals(route('requests.index'), $response->getTargetUrl());
        $this->assertEquals(302, $response->status());

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusClosed->id,
        ]);
    }

    public function test_destroy_deletes_request()
    {
        $category = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'open']);

        $request = UserRequest::factory()->create([
            'category_id' => $category->id,
            'status_id' => $status->id,
            'requester_name' => 'Fulano',
        ]);

        $controller = new RequestController;
        $response = $controller->destroy($request->id); // Passar o ID em vez do objeto

        $this->assertEquals(route('requests.index'), $response->getTargetUrl());
        $this->assertEquals(302, $response->status());
        $this->assertDatabaseMissing('requests', ['id' => $request->id]);
    }
}
