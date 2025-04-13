<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Request;
use App\Models\Status;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

    public function test_it_creates_a_request()
    {
        $category = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'open']);

        $request = Request::create([
            'title' => 'Teste de Solicitação',
            'description' => 'Descrição da solicitação',
            'category_id' => $category->id,
            'requester_name' => 'João da Silva',
            'status_id' => $status->id,
        ]);

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
        $category = Category::factory()->create();
        $statusOpen = Status::factory()->create(['name' => 'open']);
        $statusClosed = Status::factory()->create(['name' => 'closed']);

        $request = Request::factory()->create([
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

    public function test_update_status_route_updates_request_status()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $statusOpen = Status::firstOrCreate(['name' => 'aberto'], ['description' => 'Aberto']);
        $statusClosed = Status::firstOrCreate(['name' => 'fechado'], ['description' => 'Fechado']);

        $request = Request::factory()->create([
            'status_id' => $statusOpen->id,
        ]);

        $response = $this->put(route('requests.update-status', ['id_request' => $request->id]), [
            '_token' => csrf_token(),
            'status_id' => $statusClosed->id,
        ]);

        $response->assertRedirect(route('requests.index'));
        $this->assertEquals($statusClosed->id, $request->fresh()->status_id);
    }
}
