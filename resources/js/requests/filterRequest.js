
document.addEventListener('DOMContentLoaded', function () {
    function updateTable() {
        const category = document.getElementById('category').value;
        const status = document.getElementById('status').value;

        // Atualiza o link do botão de exportação
        const exportUrl = `/requests/export?category=${category}&status=${status}`;
        document.getElementById('btnExport').href = exportUrl;

        // Requisição AJAX para carregar os dados filtrados
        fetch(`/?category=${category}&status=${status}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                // Atualiza a tabela com os novos dados filtrados
                document.getElementById('requestsTable').innerHTML = html;
            });
    }

    // Adiciona evento de escuta para os selects de filtro
    document.getElementById('category').addEventListener('change', updateTable);
    document.getElementById('status').addEventListener('change', updateTable);

    // Atualiza a tabela e a URL de exportação ao carregar a página com os filtros
    updateTable();
});
