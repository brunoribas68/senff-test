<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Status;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
        $this->mock(\Illuminate\Foundation\Vite::class, function ($mock) {
            $mock->shouldReceive('__invoke')->andReturn('');
        });
    }

    public function test_update_status_route_updates_request_status()
    {

        // Create necessary data
        $category = Category::factory()->create();
        $statusOld = Status::factory()->create(['name' => 'Pendente']);
        $statusNew = Status::factory()->create(['name' => 'Concluído']);
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Create a request
        $request = UserRequest::factory()->create([
            'title' => 'Nova Solicitacao',
            'description' => 'Qualquer texto',
            'category_id' => $category->id,
            'status_id' => $statusOld->id,
            'requester_name' => 'Maria',
        ]);
        // Call the update status route
        $response = $this->put(route('requests.update-status', ['id_request' => $request->id]), [
            'status_id' => $statusNew->id,
        ]);

        // Assertions
        $response->assertRedirect(route('requests.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusNew->id,
        ]);
    }

    public function test_store_creates_request()
    {
        $category = Category::factory()->create();

        $response = $this->post(route('requests.store'), [
            'title' => 'Nova Solicitação',
            'description' => 'Descrição detalhada',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
        ]);

        $response->assertRedirect(route('requests.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('requests', [
            'title' => 'Nova Solicitação',
            'description' => 'Descrição detalhada',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);
    }

    public function test_index_applies_filters()
    {
        // Create test data
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $status1 = Status::factory()->create(['name' => 'open']);
        $status2 = Status::factory()->create(['name' => 'closed']);

        UserRequest::factory()->create(['category_id' => $category1->id, 'status_id' => $status1->id]);
        UserRequest::factory()->create(['category_id' => $category2->id, 'status_id' => $status2->id]);

        // Test category filter
        $response = $this->get(route('requests.index', ['category' => $category1->id]));
        $response->assertOk();
        $response->assertViewHas('requests', function ($requests) use ($category1) {
            return $requests->every(fn ($request) => $request->category_id === $category1->id);
        });

        // Test status filter
        $response = $this->get(route('requests.index', ['status' => $status1->id]));
        $response->assertOk();
        $response->assertViewHas('requests', function ($requests) use ($status1) {
            return $requests->every(fn ($request) => $request->status_id === $status1->id);
        });

        // Test combined filters
        $response = $this->get(route('requests.index', [
            'category' => $category1->id,
            'status' => $status1->id,
        ]));
        $response->assertOk();
        $response->assertViewHas('requests', function ($requests) use ($category1, $status1) {
            return $requests->every(fn ($request) => $request->category_id === $category1->id &&
                $request->status_id === $status1->id
            );
        });
    }

    public function test_destroy_deletes_request()
    {
        $category = Category::factory()->create();
        $request = UserRequest::factory()->create([
            'title' => 'Nova Solicitação',
            'description' => 'Descrição detalhada',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);

        $response = $this->delete(route('requests.destroy', ['id_request' => $request->id]));

        $response->assertRedirect(route('requests.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('requests', ['id' => $request->id]);
    }
}
