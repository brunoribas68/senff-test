<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Solicitação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <h1 class="h4 mb-4">Detalhes da Solicitação</h1>

    <!-- Detalhes da Solicitação -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Problema no computador</h5>
            <p class="card-text"><strong>Descrição:</strong> Computador não liga</p>
            <p class="card-text"><strong>Categoria:</strong> TI</p>
            <p class="card-text"><strong>Status:</strong> <span class="badge bg-warning text-dark">Aberto</span></p>
            <p class="card-text"><strong>Solicitante:</strong> João Silva</p>
            <p class="card-text"><strong>Data de Criação:</strong> 2025-04-01</p>
        </div>
    </div>

    <!-- Atualizar Status -->
    <h2 class="h5 mb-3">Atualizar Status</h2>
    <form action="/requests/1/update-status" method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="status" class="form-label">Novo Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="open">Aberto</option>
                <option value="in_progress">Em Progresso</option>
                <option value="closed">Fechado</option>
            </select>
        </div>

        <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Atualizar</button>
        </div>
    </form>

    <!-- Voltar para a Lista -->
    <div class="mt-4">
        <a href="/requests" class="btn btn-secondary">Voltar para a Lista</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
