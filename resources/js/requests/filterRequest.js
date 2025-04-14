document.addEventListener('DOMContentLoaded', function () {
    function updateTable(url = null) {
        const category = document.getElementById('category')?.value || '';
        const status = document.getElementById('status')?.value || '';

        const baseUrl = url || '/';
        const queryParams = new URLSearchParams({ category, status });
        const targetUrl = baseUrl.includes('?') ? `${baseUrl}&${queryParams}` : `${baseUrl}?${queryParams}`;

        fetch(targetUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newTable = doc.querySelector('#requestsTableWrapper');
                const requestsTableWrapper = document.getElementById('requestsTableWrapper');
                if (requestsTableWrapper && newTable) {
                    requestsTableWrapper.innerHTML = newTable.innerHTML;
                }

                const newPagination = doc.querySelector('#paginationWrapper');
                const paginationWrapper = document.getElementById('paginationWrapper');
                if (paginationWrapper && newPagination) {
                    paginationWrapper.innerHTML = newPagination.innerHTML;
                }

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

    const categorySelect = document.getElementById('category');
    const statusSelect = document.getElementById('status');
    if (categorySelect && statusSelect) {
        categorySelect.addEventListener('change', () => updateTable());
        statusSelect.addEventListener('change', () => updateTable());
    }

    attachPaginationEvents();
    function updateExportLink() {
        const category = document.getElementById('category')?.value || '';
        const status = document.getElementById('status')?.value || '';
        const exportRoute = document.getElementById('export_route')?.value || '/requests/export';

        const queryParams = new URLSearchParams({ category, status });
        const exportUrl = `${exportRoute}?${queryParams}`;

        const exportBtn = document.getElementById('btnExport');
        if (exportBtn) {
            exportBtn.href = exportUrl;
        }
    }

    if (categorySelect && statusSelect) {
        categorySelect.addEventListener('change', () => {
            updateTable();
            updateExportLink();
        });
        statusSelect.addEventListener('change', () => {
            updateTable();
            updateExportLink();
        });
    }

    updateExportLink();
});
