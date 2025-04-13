@extends('layouts.app')

@section('title', 'Nova Solicitação')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-card-checklist me-2"></i> Nova Solicitação
                    </h4>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('requests.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" placeholder="Informe o título"
                                   value="{{ old('title') }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="5"
                                      placeholder="Descreva sua solicitação com detalhes" required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" name="category_id" required>
                                <option selected disabled value="">Selecione uma categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="requester_name" class="form-label">Nome do Solicitante</label>
                            <input type="text" class="form-control @error('requester_name') is-invalid @enderror"
                                   id="requester_name" name="requester_name" placeholder="Digite seu nome completo"
                                   value="{{ old('requester_name') }}" required>
                            @error('requester_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send-check-fill me-2"></i> Enviar Solicitação
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted text-center small py-2">
                    Após o envio, a solicitação será processada conforme a categoria e o status selecionado.
                </div>
            </div>
        </div>
    </div>
@endsection
