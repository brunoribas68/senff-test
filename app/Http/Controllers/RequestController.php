<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as UserRequest;
use App\Models\Category;
use App\Models\Status;

class RequestController extends Controller
{
    // Exibir lista de solicitações com filtros
    public function index(Request $request)
    {
        $categories = Category::all();
        $statuses = Status::all();

        $query = UserRequest::query();

        if ($request->filled('status')) {
            $query->where('status_id', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $requests = $query->with(['category', 'status', 'user'])->get();

        return view('requests.index', compact('requests', 'categories', 'statuses'));
    }

    // Exibir formulário para criar nova solicitação
    public function create()
    {
        $categories = Category::all();
        return view('requests.create', compact('categories'));
    }

    // Salvar nova solicitação
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'user_name' => 'required|string|max:255',
        ]);

        UserRequest::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'user_name' => $validated['user_name'],
            'status_id' => Status::where('name', 'open')->first()->id, // Status padrão: "open"
        ]);

        return redirect()->route('requests.index')->with('success', 'Solicitação criada com sucesso!');
    }

    // Exibir detalhes de uma solicitação
    public function show(UserRequest $request)
    {
        return view('requests.show', compact('request'));
    }

    // Exibir formulário para editar status
    public function edit(UserRequest $request)
    {
        $statuses = Status::all();
        return view('requests.edit', compact('request', 'statuses'));
    }

    // Atualizar status da solicitação
    public function updateStatus(Request $request, UserRequest $userRequest)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $userRequest->update([
            'status_id' => $validated['status_id'],
        ]);

        return redirect()->route('requests.index')->with('success', 'Status atualizado com sucesso!');
    }

    // Remover solicitação
    public function destroy(UserRequest $request)
    {
        $request->delete();
        return redirect()->route('requests.index')->with('success', 'Solicitação removida com sucesso!');
    }
}
