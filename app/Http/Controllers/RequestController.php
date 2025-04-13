<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Exports\RequestsExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $query = UserRequest::with(['category', 'status']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'requester_name' => 'required|string|max:255',
        ]);

        UserRequest::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'requester_name' => $validated['requester_name'],
            'status_id' => Status::where('name', 'aberto')->first()->id,
        ]);

        return redirect()->route('requests.index')->with('success', 'Solicitação criada com sucesso!');
    }

    public function show(UserRequest $userRequest) {
        $statuses = Status::all();
        return view('request.detailRequest', ['request' => $userRequest, 'statuses' => $statuses]);
    }

    public function edit(UserRequest $request)
    {
        $statuses = Status::all();

        return view('request.detailRequest', compact('request', 'statuses'));
    }

    public function updateStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);
        $userRequest = UserRequest::find($id);
        $userRequest->update([
            'status_id' => $validated['status_id'],
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
        $query = UserRequest::with(['category', 'status']);

        if ($request->filled('status')) {
            $query->where('status_id', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $requests = $query->get();

        return Excel::download(new RequestsExport($requests), 'solicitacoes.xlsx');
    }
}
