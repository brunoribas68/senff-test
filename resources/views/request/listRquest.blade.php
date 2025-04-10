<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <h1 class="h4 mb-4">Lista de Solicitações</h1>

    <!-- Filtros -->
    <form class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="filterStatus" class="form-label">Status</label>
            <select id="filterStatus" name="status" class="form-select">
                <option value="">Todos</option>
                <option value="open">Aberto</option>
                <option value="in_progress">Em Progresso</option>
                <option value="closed">Fechado</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="filterCategory" class="form-label">Categoria</label>
            <select id="filterCategory" name="category" class="form-select">
                <option value="">Todas</option>
                <option value="1">TI</option>
                <option value="2">Suprimentos</option>
                <option value="3">RH</option>
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Tabela de Solicitações -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Solicitante</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <!-- Exemplo de dados dinâmicos -->
            <tr>
                <td>1</td>
                <td>Problema no computador</td>
                <td>Computador não liga</td>
                <td>TI</td>
                <td><span class="badge bg-warning text-dark">Aberto</span></td>
                <td>João Silva</td>
                <td>2025-04-01</td>
                <td>
                    <a href="/requests/1" class="btn btn-sm btn-info">Detalhes</a>
                    <a href="/requests/1/edit" class="btn btn-sm btn-warning">Editar</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Compra de materiais</td>
                <td>Papel A4 e canetas</td>
                <td>Suprimentos</td>
                <td><span class="badge bg-primary">Em Progresso</span></td>
                <td>Maria Oliveira</td>
                <td>2025-04-02</td>
                <td>
                    <a href="/requests/2" class="btn btn-sm btn-info">Detalhes</a>
                    <a href="/requests/2/edit" class="btn btn-sm btn-warning">Editar</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
