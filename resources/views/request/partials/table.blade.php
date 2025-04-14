<div id="requestsContainer">
    <div id="requestsTableWrapper">
        <table class="table table-hover align-middle mb-0" id="requestsTable">
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
                                    <a href="{{ route('requests.show', $request->id) }}" class="dropdown-item">Visualizar</a>
                                </li>
                                <li>
                                    <a href="{{ route('requests.edit', $request->id) }}" class="dropdown-item">Editar</a>
                                </li>
                                <li>
                                    <form action="{{ route('requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta solicitação?');">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">Excluir</button>
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
    <div id="paginationWrapper">
        {{ $requests->links() }}
    </div>
</div>
