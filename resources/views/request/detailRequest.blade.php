@extends('layouts.app')

@section('title', 'Detalhes da Solicitação')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4">Detalhes da Solicitação</h1>
            <a href="{{ route('requests.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para a Lista
            </a>
        </div>

        <!-- Detalhes da Solicitação -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $request->title ?? 'Título da Solicitação' }}</h5>
                <p class="mb-1"><strong>Descrição:</strong> {{ $request->description ?? 'Não informada' }}</p>
                <p class="mb-1"><strong>Categoria:</strong> {{ $request->category->name ?? 'Não definida' }}</p>
                <p class="mb-1">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ getStatusColor($request->status->name ?? 'Aberto') }}">
                    {{ $request->status->name ?? 'Aberto' }}
                </span>
                </p>
                <p class="mb-1"><strong>Solicitante:</strong> {{ $request->requester_name ?? 'Anônimo' }}</p>
                <p class="mb-0"><strong>Data de Criação:</strong> {{ $request->created_at ? $request->created_at->format('d/m/Y H:i') : '-' }}</p>
            </div>
        </div>

        <!-- Atualizar Status -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Atualizar Status</h2>
                <form action="{{ route('requests.update-status', $request->id) }}" method="POST" class="row g-3">
                    @csrf
                        @method('PUT')
                    <div class="col-md-6">
                        <label for="status_id" class="form-label">Novo Status</label>
                        <select id="status_id" name="status_id" class="form-select" required>
                            <option value="">Selecione um status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $request->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle"></i> Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
