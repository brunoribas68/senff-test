<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Solicitação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 500px;">
    <h1 class="h4 text-center mb-4">Nova Solicitação</h1>
    <form action="/requests" method="POST">
        <!-- Campo Título -->
        <div class="mb-3">
            <label for="title" class="form-label">Título *</label>
            <input type="text" id="title" name="title"
                   class="form-control"
                   placeholder="Digite o título da solicitação" required>
        </div>

        <!-- Campo Descrição -->
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea id="description" name="description" rows="4"
                      class="form-control"
                      placeholder="Detalhe sua solicitação (opcional)"></textarea>
        </div>

        <!-- Campo Categoria -->
        <div class="mb-3">
            <label for="category" class="form-label">Categoria *</label>
            <select id="category" name="category"
                    class="form-select" required>
                <option value="">Selecione uma categoria</option>
                <option value="1">TI</option>
                <option value="2">Suprimentos</option>
                <option value="3">RH</option>
            </select>
        </div>

        <!-- Campo Solicitante -->
        <div class="mb-3">
            <label for="user" class="form-label">Seu Nome *</label>
            <input type="text" id="user" name="user"
                   class="form-control"
                   placeholder="Digite seu nome" required>
        </div>

        <!-- Botão de Enviar -->
        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">
                Criar Solicitação
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
