<?php

namespace App\Http\Controllers;

use App\Exports\RequestsExport;
use App\Http\Requests\StoreRequestRequest;
use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->buildFilteredQuery($request);

        $requests = $query->latest()->get();
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

    public function store(StoreRequestRequest $request)
    {

        UserRequest::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'requester_name' => $request['requester_name'],
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);

        return redirect()->route('requests.index')->with('success', 'Solicitação criada com sucesso!');
    }

    public function show(UserRequest $userRequest)
    {
        $statuses = Status::all();

        return view('request.detailRequest', ['request' => $userRequest, 'statuses' => $statuses]);
    }

    public function edit(UserRequest $userRequest)
    {
        $statuses = Status::all();

        return view('request.detailRequest', ['request' => $userRequest, 'statuses' => $statuses]);
    }

    public function updateStatus($id, Request $request)
    {
        $userRequest = UserRequest::findOrFail($id); // Deve retornar apenas um item

        $userRequest->update([
            'status_id' => $request['status_id'],
        ]);

        return redirect()->route('requests.index')->with('success', 'Status atualizado com sucesso!');
    }

    public function destroy(UserRequest $request)
    {
        $request->delete();

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
