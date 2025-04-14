@extends('layouts.app')

@section('title', 'Lista de Solicitações')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="bi bi-list-check me-2"></i> Solicitações Registradas
            </h3>
            <div class="d-flex gap-2">
                <a href="{{ route('requests.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Nova Solicitação
                </a>
                <a href="{{ route('requests.export') }}" id="btnExport" class="btn btn-outline-secondary">
                    <i class="bi bi-download me-1"></i> Exportar Excel
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Filtros --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="category" class="form-label">Categoria</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Todos</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @include('request.partials.table', ['requests' => $requests])
    </div>
@endsection

@vite(['resources/js/requests/filterRequest.js'])
