<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Solicitação')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Vite (substituindo o Laravel Mix) -->
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>
<body class="py-4">

<!-- Navbar simples opcional -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{route('requests.index')}}">
            <i class="bi bi-clipboard-check me-2"></i> Sistema de Solicitação
        </a>
    </div>
</nav>

<!-- Conteúdo da página -->
<main class="container">
    @yield('content')
</main>

<!-- Bootstrap JS (opcional se usar componentes JS como collapse/modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
