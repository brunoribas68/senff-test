document.addEventListener('DOMContentLoaded', function () {
    function updateTable(url = null) {
        // Pegar valores dos filtros
        const category = document.getElementById('category')?.value || '';
        const status = document.getElementById('status')?.value || '';

        // Construir a URL para a requisição
        const baseUrl = url || '/';
        const queryParams = new URLSearchParams({ category, status });
        const targetUrl = baseUrl.includes('?') ? `${baseUrl}&${queryParams}` : `${baseUrl}?${queryParams}`;

        // Requisição AJAX para carregar os dados filtrados
        fetch(targetUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Atualizar a tabela
                const newTable = doc.querySelector('#requestsTableWrapper');
                const requestsTableWrapper = document.getElementById('requestsTableWrapper');
                if (requestsTableWrapper && newTable) {
                    requestsTableWrapper.innerHTML = newTable.innerHTML;
                }

                // Atualizar a paginação
                const newPagination = doc.querySelector('#paginationWrapper');
                const paginationWrapper = document.getElementById('paginationWrapper');
                if (paginationWrapper && newPagination) {
                    paginationWrapper.innerHTML = newPagination.innerHTML;
                }

                // Reaplicar eventos de paginação após atualizar a tabela
                attachPaginationEvents();
            })
            .catch(error => {
                console.error('Erro ao carregar os dados filtrados:', error);
            });
    }

    function attachPaginationEvents() {
        const paginationLinks = document.querySelectorAll('#paginationWrapper .pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.href;
                updateTable(url);
            });
        });
    }

    // Inicializar os eventos nos filtros
    const categorySelect = document.getElementById('category');
    const statusSelect = document.getElementById('status');
    if (categorySelect && statusSelect) {
        categorySelect.addEventListener('change', () => updateTable());
        statusSelect.addEventListener('change', () => updateTable());
    }

    // Reaplicar eventos de paginação na primeira carga
    attachPaginationEvents();
});
