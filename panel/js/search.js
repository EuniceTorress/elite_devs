document.addEventListener('DOMContentLoaded', function() {
    const stockTable = document.getElementById('stockTable');
    const filterSelect = document.getElementById('filterSelect');
    const itemCount = document.getElementById('itemCount');
    const allCheckbox = document.getElementById('all');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const searchInput = document.getElementById('searchInput');
    const originalRows = Array.from(stockTable.rows);
    let sortOrder = { column: null, ascending: true };

    function updateItemCount(count) {
        itemCount.textContent = `Showing ${count} items`;
    }

    function filterTable() {
        const selectedFilter = filterSelect.value;
        const selectedCategories = Array.from(categoryCheckboxes)
            .filter(checkbox => checkbox.checked && checkbox !== allCheckbox)
            .map(checkbox => checkbox.value);
        const searchQuery = searchInput.value.toLowerCase();

        let filteredRows = originalRows.filter(row => {
            const rowCategory = row.dataset.category;
            const rowQuantity = parseInt(row.cells[4].textContent);
            const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(rowCategory);
            const matchesFilter = (selectedFilter === 'low' && rowQuantity <= 5) ||
                                  (selectedFilter === 'high' && rowQuantity > 5) ||
                                  selectedFilter === '';

            const matchesSearch = Array.from(row.cells).some(cell => 
                cell.textContent.toLowerCase().includes(searchQuery)
            );

            return matchesCategory && matchesFilter && matchesSearch;
        });

        if (sortOrder.column !== null) {
            filteredRows.sort((a, b) => {
                const aValue = a.cells[sortOrder.column].textContent.trim();
                const bValue = b.cells[sortOrder.column].textContent.trim();
                const aNum = parseFloat(aValue.replace(/[^0-9.-]+/g, '')) || aValue;
                const bNum = parseFloat(bValue.replace(/[^0-9.-]+/g, '')) || bValue;

                if (aNum > bNum) return sortOrder.ascending ? 1 : -1;
                if (aNum < bNum) return sortOrder.ascending ? -1 : 1;
                return 0;
            });
        }

        stockTable.innerHTML = '';
        if (filteredRows.length > 0) {
            filteredRows.forEach(row => stockTable.appendChild(row));
        } else {
            stockTable.innerHTML = '<tr><td colspan="6">No items found</td></tr>';
        }
        updateItemCount(filteredRows.length);
    }

    function updateSelectAllCheckbox() {
        const checkedCount = Array.from(categoryCheckboxes).filter(checkbox => checkbox.checked && checkbox !== allCheckbox).length;
        const categoryCount = Array.from(categoryCheckboxes).filter(checkbox => checkbox !== allCheckbox).length;
        allCheckbox.checked = checkedCount === categoryCount && categoryCount > 0;
    }

    function sortTable(columnIndex) {
        const headers = document.querySelectorAll('.table th.sortable');
        headers.forEach((header, index) => {
            const sortIcon = header.querySelector('.sort-icon');
            if (index === columnIndex) {
                sortOrder.column = columnIndex;
                sortOrder.ascending = !sortOrder.ascending;
                sortIcon.classList.toggle('fa-sort-up', sortOrder.ascending);
                sortIcon.classList.toggle('fa-sort-down', !sortOrder.ascending);
            } else {
                sortIcon.classList.remove('fa-sort-up', 'fa-sort-down');
            }
        });
        filterTable();
    }

    filterSelect.addEventListener('change', filterTable);

    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this !== allCheckbox) {
                updateSelectAllCheckbox();
            }
            filterTable();
        });
    });

    allCheckbox.addEventListener('change', function() {
        categoryCheckboxes.forEach(checkbox => {
            if (checkbox !== allCheckbox) {
                checkbox.checked = allCheckbox.checked;
            }
        });
        filterTable();
    });

    searchInput.addEventListener('input', filterTable);

    document.querySelectorAll('.table th.sortable').forEach((header, index) => {
        header.addEventListener('click', () => sortTable(index));
    });

    updateItemCount(originalRows.length);
});
