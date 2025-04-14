<?php

namespace App\Http\Controllers;

use App\Exports\RequestsExport;
use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->buildFilteredQuery($request);

        $requests = $query->latest()->paginate(5);
        $categories = Category::all();
        $statuses = Status::all();
        if ($request->ajax()) {
            return view('request.partials.table', compact('requests'))->render();
        }

        return view('request.indexRequest', compact('requests', 'categories', 'statuses'));
    }

    public function create()
    {
        $categories = Category::all(); // Todas as categorias
        $statuses = Status::all(); // Todos os status

        return view('request.formRequest', compact('categories', 'statuses'));
    }

    public function store(StoreRequest $request)
    {

        $userRequest = UserRequest::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'requester_name' => $request['requester_name'],
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);

        Log::info('Solicitação criada', ['id' => $userRequest->id, 'title' => $userRequest->title]);

        return redirect()->route('requests.index')->with('success', 'Solicitação criada com sucesso!');
    }

    public function show($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $statuses = Status::all();
        dd($userRequest);

        return view('request.detailRequest', ['request' => $userRequest, 'statuses' => $statuses]);
    }

    public function edit($id)
    {
        $userRequest = UserRequest::findOrFail($id);

        $statuses = Status::all();

        return view('request.detailRequest', ['request' => $userRequest, 'statuses' => $statuses]);
    }

    public function updateStatus(Request $httpRequest, $id)
    {
        $userRequest = UserRequest::findOrFail($id);

        $oldStatus = $userRequest->status_id;

        $userRequest->update([
            'status_id' => $httpRequest->input('status_id'),
        ]);

        Log::info('Status da solicitação atualizado', [
            'id' => $userRequest->id,
            'old_status' => $oldStatus,
            'new_status' => $httpRequest->input('status_id'),
        ]);

        return redirect()->route('requests.index')->with('success', 'Status atualizado com sucesso!');
    }

    public function destroy($id_request): RedirectResponse
    {
        if (! is_object($id_request)) {
            $id_request = UserRequest::find($id_request);
        }

        $id_request->forceDelete();

        Log::warning('Solicitação excluída', ['id' => $id_request->id, 'title' => $id_request->title]);

        return redirect()->route('requests.index')->with('success', 'Solicitação removida com sucesso!');
    }

    public function export(Request $request)
    {
        $query = $this->buildFilteredQuery($request);

        $requests = $query->get();

        return Excel::download(new RequestsExport($requests), 'solicitacoes.xlsx');
    }

    private function buildFilteredQuery(Request $request)
    {
        $query = UserRequest::with(['category', 'status']);

        if ($request->filled('status')) {
            $query->where('status_id', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        return $query;
    }
}
