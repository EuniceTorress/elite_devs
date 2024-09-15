<?php
include 'modal/stocks.php';
include 'modal/stocks/stock-card.php';
?>
<style>

#stock-container {
    height: 90vh;
    overflow-y: auto;
    overflow-x: hidden;
    margin: 0 auto;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px 15px;
    text-align: left;
    font-size: 0.8rem;
    transition: background-color 0.2s ease, color 0.2s ease;
}

th {
    color: maroon;
    position: relative;
    cursor: pointer;
    font-size: 0.8rem;
    user-select: none;
    border-top: 1px solid maroon;
    border-bottom: 1px solid maroon;
    transition: background-color 0.2s ease;
}

th:hover {
    background-color: #f5f5f5;
    box-shadow: inset 0 10px 10px rgba(0, 0, 0, 0.1);
}

tbody tr:hover {
    background-color: #f9f9f9;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2);
}

th::after {
    content: '\25BC';
    font-size: 0.8rem;
    position: absolute;
    right: 30px;
    color: maroon;
    transition: transform 0.2s ease, color 0.2s ease;
}

th.show::after {
    transform: rotate(180deg);
}

td {
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.2s ease;
}

tr:last-child td {
    border-bottom: none;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    min-width: 200px;
    box-shadow: 0 15px 13px rgba(0, 0, 0, 0.1);
    z-index: 1;
    max-height: 200px;
    overflow-y: auto;
    border-radius: 8px;
    right: 0;
    top: 100%;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translateY(-10px);
    opacity: 0;
    pointer-events: none;
    padding: 10px;
}

.dropdown-content.show {
    display: block;
    transform: translateY(0);
    opacity: 1;
    pointer-events: auto;
}

.dropdown-content label {
    align-items: center;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 0.8rem;
    color: #333;
    transition: background-color 0.2s ease;
}

.dropdown-content input[type="checkbox"] {
    margin-right: 10px;
}

.select-all {
    align-items: center;
    padding: 8px 20px;
    font-size: 0.8rem;
    cursor: pointer;
    border-bottom: 1px solid #e0e0e0;
    background-color: #f9f9f9;
    transition: background-color 0.2s ease;
}

.select-all input[type="checkbox"] {
    margin-right: 20px;
}

.clear-filter {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
    font-size: 0.8rem;
    color: #800000;
    display: none;
    transition: color 0.2s ease;
}

.clear-filter:hover {
    color: #a52a2a;
}

.filter-active {
    background-color: #d1ecf1;
    font-weight: bold;
}

#noResults {
    display: none;
    text-align: center;
    font-weight: bold;
    padding: 20px;
    background-color: #f8d7da;
    color: #721c24;
    border-radius: 8px;
    margin-top: 20px;
}

#resultCount {
    margin-right: 20px;
    margin-bottom: 10px;
    margin-top: 10px;
    font-weight: bold;
    text-align: right;
    color: #800000;
    font-size: 0.8rem;
}

#apply-unit_cost-filter,
#clear-unit_cost-filter,
#clear-unit_price-filter,
#apply-unit_price-filter {
    color: white;
    font-size: 0.8rem;
    outline: none;
    box-shadow: none;
    border-radius: 5px;
    padding: 5px 15px;
    border: none;
}

#apply-unit_cost-filter:hover,
#clear-unit_cost-filter:hover,
#clear-unit_price-filter:hover,
#apply-unit_price-filter:hover {
    background-color: black;
}

#clear-unit_cost-filter,
#clear-unit_price-filter {
    background-color: rgba(255, 0, 0, 0.9);
}

#apply-unit_cost-filter,
#apply-unit_price-filter {
    background-color: green;
}

.range-filter {
    margin: 10px;
}

.range-filter input[type="number"] {
    margin-bottom: 10px;
}

.range-filter .acbtnrow {
    margin: 0;
}

#newArrival .modal-dialog {
    max-width: 90% !important;
    height: 80% !important;
}

#newArrival .modal-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

#newArrival .modal-body {
    overflow-y: auto;
}

#newArrival .modal-footer {
    flex-shrink: 0;
    justify-content: space-between;
}

#newArrival .modal-header {
    flex-shrink: 0;
    padding: 0;
    padding-top: 10px;
}

#newArrival .modal-header .modal-title {
    margin: 0;
}

#newArrival .modal-header .form-group {
    margin: 0;
}

#newArrival .modal {
    display: none; 
    position: fixed;
    z-index: 3; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
}

#newArrival .additional-category,
#newArrival .size-field {
    display: none;
    margin-top: 27px;
}

#newArrival .lb {
    text-align: justify;
    font-size: 0.8rem;
    padding: 5px;
}

#newArrival .form-group label {
    font-weight: bold;
    font-size: 0.8rem;
    display: block;
}

#newArrival .form-control {
    border-radius: 10px;
    padding: 0.5rem;
    border: 1px solid #ced4da;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    font-size: 0.8rem;
}

#newArrival .form-control:focus {
    border-color: maroon;
    outline: none;
    box-shadow: 0 0 0 0.1rem rgba(128, 0, 0, 0.2);
}

#newArrival .stock-field .lb {
    padding: 15px;
    font-size: 0.8rem;
}

#newArrival #stockCount {
    max-width: 60px;
}

#newArrival .stock-field .rb-yes {
    margin-top: -25px;
}

#newArrival .close {
    position: absolute;
    right: 20px;
    transition: 0.3s all ease;
    outline: none;
    box-shadow: none;
}

#newArrival .close:hover {
    color: maroon;
    font-weight: bold;
}

#newArrival .btn-success {
    background-color: green;
    outline: none;
    box-shadow: none;
    font-size: 0.8rem;
}

#newArrival .btn-success:hover {
    background-color: black;
    color: white;
}

.autocomplete-suggestions {
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    position: absolute;
    z-index: 1000;
    max-height: 150px;
    overflow-y: auto;
    font-size: 0.8rem;
}

.autocomplete-suggestions div {
    padding: 5px;
    cursor: pointer;
    width: 170px;
}

.autocomplete-suggestions div:hover {
    background-color: #e9e9e9;
}

#messageModal {
    display: none; 
    position: fixed;
    z-index: 4; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
}


#messageModal .modal-dialog {
    max-width: 80% !important;
}

#messageModal .modal-content {
    display: flex;
    flex-direction: column;
}

#messageModal .modal-header {
    padding: 1rem;
}

#messageModal .modal-header .close {
    margin: 0;
}

#messageModal .modal-body {
    flex: 1;
    padding: 1rem;
}

#messageModal .modal-footer {
    padding: 1rem;
    display: flex;
    justify-content: flex-end;
}

.overlay {
    display: none; 
    position: fixed;
    z-index: 3; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); 
}

</style>
<link rel="stylesheet" href="css/stock.css">

<div class="table-container" id="stock-container">
    <div id="resultCount" style="display: none;">Showing X results</div>
    <table id="stocksTable">
        <thead>
            <tr>
                <th style="width: 20%;">ID
                    <div class="dropdown-content" data-column="stock_no">
                        <div class="sort-options">
                            <label><input type="radio" name="sort-id" value="asc"> &#x2191;</label>
                            <label><input type="radio" name="sort-id" value="desc"> &#x2193;</label>
                        </div>
                    </div>
                    <span class="clear-filter" data-column="stock_no">&#x2716;</span>
                </th>
                <th style="width: 35%;">Item Name (Description)
                    <div class="dropdown-content" data-column="name">
                        <div class="sort-options">
                            <label><input type="radio" name="sort-name" value="a-z"> A-Z</label><br>
                            <label><input type="radio" name="sort-name" value="z-a"> Z-A</label>
                        </div>
                    </div>
                    <span class="clear-filter" data-column="name">&#x2716;</span>
                </th>
                <th style="width: 15%;">Category
                    <div class="dropdown-content" data-column="category">
                        <input type="checkbox" class="select-all" id="select-all-category"> Select All<br>
                    </div>
                    <span class="clear-filter" data-column="category">&#x2716;</span>
                </th>
                <th style="width: 10%;">Unit Price
                    <div class="dropdown-content" data-column="unit_price">
                        <div class="range-filter">
                            <input type="number" class="min-range" id="min-unit_price" placeholder="Min">
                            <input type="number" class="max-range" id="max-unit_price" placeholder="Max">
                            <a type="button" id="apply-unit_price-filter" class="btn">Apply</a>
                            <a type="button" id="clear-unit_price-filter" class="btn">Clear</a>
                        </div>
                    </div>
                    <span class="clear-filter" data-column="unit_price">&#x2716;</span>
                </th>
                <th style="width: 10%;">Unit Cost
                    <div class="dropdown-content" data-column="unit_cost">
                        <div class="range-filter">
                            <input type="number" class="min-range" id="min-unit_cost" placeholder="Min">
                            <input type="number" class="max-range" id="max-unit_cost" placeholder="Max">
                            <a type="button" id="apply-unit_cost-filter" class="btn">Apply</a>
                            <a type="button" id="clear-unit_cost-filter" class="btn">Clear</a>
                        </div>
                    </div>
                    <span class="clear-filter" data-column="unit_cost">&#x2716;</span>
                </th>
                <th style="width: 10%;">Qty
                    <div class="dropdown-content" data-column="quantity">
                        <input type="checkbox" class="select-all" id="select-all-quantity"> Select All<br>
                        <div class="filter-options">
                            <label><input type="checkbox" name="filter-quantity" value="low"> Low Stocks</label><br>
                            <label><input type="checkbox" name="filter-quantity" value="average"> Average Stocks</label><br>
                            <label><input type="checkbox" name="filter-quantity" value="high"> High Stocks</label>
                        </div>
                    </div>
                    <span class="clear-filter" data-column="quantity">&#x2716;</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr id="noResults" style="display: none;">
                <td colspan="6">No results found</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="js/stocks/daily-stocks.js"></script>
<!-- <script src="js/stocks/stock-modal/stock-modal.js"></script> -->
<script type="module" src="js/stocks/new-arrival/stock-modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('tbody');
    const noResultsRow = document.getElementById('noResults');
    const resultCount = document.getElementById('resultCount');
    const filters = {};
    const sortOptions = {};
    let currentDropdown = null;

    function populateTable(stocks) {
        tableBody.innerHTML = ''; 
        if (stocks.length > 0) {
            stocks.forEach(stock => {
                const row = document.createElement('tr');
                row.setAttribute('data-stock-id', stock.stock_no); 
                row.innerHTML = `
                    <td>${stock.stock_no}</td>
                    <td>${stock.name}</td>
                    <td>${stock.category}</td>
                    <td>₱ ${parseFloat(stock.unit_price).toFixed(2)}</td>
                    <td>₱ ${parseFloat(stock.unit_cost).toFixed(2)}</td>
                    <td>${stock.quantity}</td>
                `;

                row.addEventListener('click', function() {
                    const stockId = this.getAttribute('data-stock-id'); 
                    openModal(stockId); 
                });

                tableBody.appendChild(row);
            });
            resultCount.textContent = `Showing ${stocks.length} result${stocks.length > 1 ? 's' : ''}`;
            resultCount.style.display = '';
            noResultsRow.style.display = 'none';
        } else {
            noResultsRow.style.display = '';
            resultCount.style.display = 'none';
        }
    }

    function applyFilters(stocks) {
        return stocks.filter(stock => {
            return Object.keys(filters).every(column => {
                const filter = filters[column];
                const value = stock[column];

                if (filter.type === 'checkbox') {
                    return filter.values.length === 0 || filter.values.includes(value);
                } else if (filter.type === 'range') {
                    const min = parseFloat(filter.min) || -Infinity;
                    const max = parseFloat(filter.max) || Infinity;
                    return value >= min && value <= max;
                } else if (filter.type === 'quantity') {
                    const maxQuantity = Math.max(...stocks.map(s => s.quantity));
                    const percentage = (value / maxQuantity) * 100;
                    if (filter.values.includes('low')) {
                        return percentage < 40;
                    } else if (filter.values.includes('average')) {
                        return percentage >= 40 && percentage < 75;
                    } else if (filter.values.includes('high')) {
                        return percentage >= 75;
                    }
                }
                return true;
            });
        });
    }

    function applySorting(stocks) {
        const sortBy = sortOptions.column;
        const sortOrder = sortOptions.order;
        if (sortBy && sortOrder) {
            return stocks.sort((a, b) => {
                if (sortBy === 'name') {
                    return sortOrder === 'a-z' ? a[sortBy].localeCompare(b[sortBy]) : b[sortBy].localeCompare(a[sortBy]);
                } else if (sortBy === 'unit_price' || sortBy === 'unit_cost') {
                    return sortOrder === 'low-high' ? a[sortBy] - b[sortBy] : b[sortBy] - a[sortBy];
                } else if (sortBy === 'stock_no') {
                    return sortOrder === 'asc' ? a[sortBy] - b[sortBy] : b[sortBy] - a[sortBy];
                }
                return 0;
            });
        }
        return stocks;
    }

    function fetchStockData() {
        fetch('../sql/js/stock.php')
            .then(response => response.json())
            .then(data => {
                initializeFilters(data);
                let filteredData = applyFilters(data);
                filteredData = applySorting(filteredData);
                populateTable(filteredData);
            })
            .catch(error => console.error('Error fetching stock data:', error));
    }

    function populateFilters(column, values) {
        const dropdownContent = document.querySelector(`.dropdown-content[data-column="${column}"]`);
        const uniqueValues = [...new Set(values)];

        let filterHtml = '';

        if (column === 'name') {
            filterHtml = `
                <div class="sort-options">
                    <label><input type="radio" name="sort-name" value="a-z"> A-Z</label><br>
                    <label><input type="radio" name="sort-name" value="z-a"> Z-A</label>
                </div>
            `;
        } else if (column === 'unit_price' || column === 'unit_cost') {
            filterHtml = `
                <div class="range-filter">
                    <input type="number" class="min-range" id="min-${column}" placeholder="Min">
                    <input type="number" class="max-range" id="max-${column}" placeholder="Max">
                    <div class="row justify-content-between acbtnrow">
                        <button id="clear-${column}-filter">Clear</button>
                        <button id="apply-${column}-filter">Apply</button>
                    </div>
                </div>
            `;
        } else if (column === 'quantity' || column === 'category') {
            filterHtml = `
                <input type="checkbox" class="select-all" id="select-all-${column}"> Select All<br>
                <div class="filter-options">
                    ${uniqueValues.map(value => `
                        <input type="checkbox" class="filter-checkbox" id="${column}-${value}" value="${value}">
                        <label for="${column}-${value}">${value}</label><br>
                    `).join('')}
                </div>
            `;
        }

        dropdownContent.innerHTML = filterHtml;

        if (column === 'unit_price' || column === 'unit_cost') {
            const applyFilterButton = document.getElementById(`apply-${column}-filter`);
            const clearFilterButton = document.getElementById(`clear-${column}-filter`);
            if (applyFilterButton) {
                applyFilterButton.addEventListener('click', function() {
                    const min = parseFloat(document.getElementById(`min-${column}`).value) || -Infinity;
                    const max = parseFloat(document.getElementById(`max-${column}`).value) || Infinity;
                    filters[column] = {
                        type: 'range',
                        min: min,
                        max: max
                    };
                    let data = JSON.parse(localStorage.getItem('stockData')) || [];
                    let filteredData = applyFilters(data);
                    filteredData = applySorting(filteredData);
                    populateTable(filteredData);
                });
            }
            if (clearFilterButton) {
                clearFilterButton.addEventListener('click', function() {
                    document.getElementById(`min-${column}`).value = '';
                    document.getElementById(`max-${column}`).value = '';
                    delete filters[column];
                    let data = JSON.parse(localStorage.getItem('stockData')) || [];
                    let filteredData = applyFilters(data);
                    filteredData = applySorting(filteredData);
                    populateTable(filteredData);
                });
            }
        }

        document.querySelectorAll(`.dropdown-content[data-column="${column}"] input[type="radio"]`).forEach(radio => {
            radio.addEventListener('change', function() {
                sortOptions.column = column;
                sortOptions.order = this.value;
                let data = JSON.parse(localStorage.getItem('stockData')) || [];
                let filteredData = applyFilters(data);
                filteredData = applySorting(filteredData);
                populateTable(filteredData);
            });
        });

        document.querySelectorAll(`.dropdown-content[data-column="${column}"] input[type="checkbox"]`).forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectAllCheckbox = dropdownContent.querySelector('.select-all');

                if (this.classList.contains('select-all')) {
                    const isChecked = this.checked;
                    dropdownContent.querySelectorAll('input[type="checkbox"]:not(.select-all)').forEach(cb => cb.checked = isChecked);
                    filters[column] = {
                        type: 'checkbox',
                        values: isChecked ? uniqueValues : []
                    };
                } else {
                    const selectedValues = Array.from(dropdownContent.querySelectorAll('input[type="checkbox"]:not(.select-all):checked'))
                                                .map(cb => cb.value);

                    if (selectedValues.length === uniqueValues.length) {
                        selectAllCheckbox.checked = true;
                    } else {
                        selectAllCheckbox.checked = false;
                    }

                    filters[column] = {
                        type: 'checkbox',
                        values: selectedValues
                    };
                }

                let data = JSON.parse(localStorage.getItem('stockData')) || [];
                let filteredData = applyFilters(data);
                filteredData = applySorting(filteredData);
                populateTable(filteredData);
            });
        });
    }

    function initializeFilters(stocks) {
        localStorage.setItem('stockData', JSON.stringify(stocks));
        const uniqueValues = {
            stock_no: [],
            name: [],
            category: [],
            unit_price: [],
            unit_cost: [],
            quantity: []
        };

        stocks.forEach(stock => {
            uniqueValues.stock_no.push(stock.stock_no);
            uniqueValues.name.push(stock.name);
            uniqueValues.category.push(stock.category);
            uniqueValues.unit_price.push(stock.unit_price);
            uniqueValues.unit_cost.push(stock.unit_cost);
            uniqueValues.quantity.push(stock.quantity);
        });

        Object.keys(uniqueValues).forEach(column => {
            populateFilters(column, uniqueValues[column]);
        });
    }

    document.querySelectorAll('.clear-filter').forEach(clearButton => {
        clearButton.addEventListener('click', function() {
            const column = this.dataset.column;
            delete filters[column];
            const dropdownContent = this.previousElementSibling;
            dropdownContent.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            dropdownContent.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.checked = false;
            });
            dropdownContent.querySelectorAll('.min-range').forEach(input => input.value = '');
            dropdownContent.querySelectorAll('.max-range').forEach(input => input.value = '');
            const data = JSON.parse(localStorage.getItem('stockData')) || [];
            const filteredData = applyFilters(data);
            const sortedData = applySorting(filteredData);
            populateTable(sortedData);
        });
    });

    document.querySelectorAll('th').forEach(header => {
        const dropdown = header.querySelector('.dropdown-content');

        header.addEventListener('click', function(e) {
            e.stopPropagation();
            if (currentDropdown && currentDropdown !== dropdown) {
                currentDropdown.classList.remove("show");
                currentDropdown.parentNode.classList.remove("show");
            }
            dropdown.classList.toggle("show");
            header.classList.toggle("show");
            currentDropdown = dropdown;
        });

        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        window.addEventListener('click', function(event) {
            if (!header.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
                header.classList.remove('show');
                currentDropdown = null;
            }
        });
    });

    fetchStockData();
});

</script>
