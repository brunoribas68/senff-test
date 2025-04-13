
@if($requests->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
            <tr>
                <th>Título</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Solicitante</th>
                <th class="text-end">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->title }}</td>
                    <td>{{ $request->category->name ?? '-' }}</td>
                    <td>
                            <span class="badge bg-{{ getStatusColor($request->status->name ?? '') }}">
                                {{ $request->status->name ?? 'Sem Status' }}
                            </span>
                    </td>
                    <td>{{ $request->requester_name }}</td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Ações
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('requests.show', $request->id) }}" class="dropdown-item">
                                        <i class="bi bi-eye me-1"></i> Visualizar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('requests.edit', $request->id) }}" class="dropdown-item">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta solicitação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="bi bi-trash me-1"></i> Excluir
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="p-4 text-center text-muted">
        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
        Nenhuma solicitação encontrada.
    </div>
@endif
