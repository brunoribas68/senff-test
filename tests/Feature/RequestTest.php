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

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_update_status_route_updates_request_status()
    {
        // Criação de categorias e status
        $category = Category::factory()->create();
        $statusOld = Status::firstOrCreate(['name' => 'Pendente'], ['description' => 'Status pendente']);
        $statusNew = Status::firstOrCreate(['name' => 'Concluído'], ['description' => 'Status concluído']);

        // Criação de uma requisição
        $request = Request::factory()->create([
            'category_id' => $category->id,
            'status_id' => $statusOld->id,
            'requester_name' => 'Maria',
        ]);

        // Chamada para a rota de atualização do status
        $response = $this->put(route('requests.update-status', ['id_request' => $request->id]), [
            '_token' => csrf_token(),  // CSRF token
            'status_id' => $statusNew->id,
        ]);

        // Verifique se a requisição foi redirecionada para a página de solicitações
        $response->assertRedirect(route('requests.index'));

        // Verifique se o status da solicitação foi atualizado no banco de dados
        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status_id' => $statusNew->id,
        ]);
    }
}
