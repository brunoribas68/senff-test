<table>
    <thead>
    <tr>
        <th>Título</th>
        <th>Categoria</th>
        <th>Status</th>
        <th>Solicitante</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td>{{ $request->title }}</td>
            <td>{{ $request->category->name ?? 'Sem Categoria' }}</td>
            <td>{{ $request->status->name ?? 'Sem Status' }}</td>
            <td>{{ $request->requester_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
