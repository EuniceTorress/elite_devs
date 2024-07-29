<?php
include '../sql/stocks.php';
include 'modal/stock-card.php';
?>

<style>
    #sidebar-stocks {
        display: flex;
        flex-direction: row;
    }

    .stock-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        flex-grow: 1;
    }

    #sidebar-stocks .sidebar {
        width: 300px;
        padding: 20px;
        border-right: 1px solid #dee2e6;
        overflow-y: auto;
        max-height: 100vh; /* Make sidebar fit within the screen */
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
    }

    #sidebar-stocks .sidebar h2 {
        font-size: 1.25rem;
        margin-bottom: 20px;
    }

    #sidebar-stocks .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #sidebar-stocks .sidebar ul li {
        margin: 10px 0;
        font-size: 14px;
        cursor: pointer;
        position: relative;
    }

    #sidebar-stocks .sidebar ul li:hover {
        color: maroon;
        font-weight: bold;
    }

    #sidebar-stocks .sidebar .header {
        width: 100%;
        padding-bottom: 20px;
    }

    .subcategory-dropdown {
        display: none;
        padding-left: 20px;
        list-style: none;
        position: relative;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .category-label.active .subcategory-dropdown {
        display: block;
    }

    .subcategory-label {
        display: flex;
        align-items: center;
        font-size: 12px;
        margin: 5px 0;
    }

    .subcategory-label .custom-checkbox {
        width: 10px;
        height: 10px;
        margin: 0 5px 0 10px;
    }

    .table-container {
        padding: 20px;
        border-radius: 0.5rem;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        background-color: white;
        position: relative;
    }

    .table {
        width: 100%;
        table-layout: auto;
        border-collapse: collapse;
    }

    .table thead {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 10;
    }

    .table th,
    .table td {
        vertical-align: middle;
        padding: 10px;
    }

    .table th.sortable {
        cursor: pointer;
        position: relative;
    }

    .table th.sortable:hover {
        color: maroon;
        font-weight: bold;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 7px rgba(0, 0, 0, 0.6);
    }

    .img-tbl {
        height: 20px;
        margin: 5px 20px;
        width: auto;
        object-fit: cover;
        border-radius: 50%;
    }

    #sidebar-stocks .form-control {
        border-radius: 10px;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-size: 14px;
    }

    #sidebar-stocks .form-control:focus {
        border-color: maroon;
        outline: none;
        box-shadow: 0 0 0 0.1rem rgba(128, 0, 0, 0.2);
    }

    .low-stock {
        background-color: #ffcccc !important;
    }

    .sort-icon {
        margin-left: 5px;
        font-size: 0.75rem;
    }

    input[type="checkbox"] {
        display: none;
    }

    #sidebar-stocks .custom-checkbox {
        display: inline-block;
        width: 12px;
        height: 12px;
        background-color: #f0f0f0;
        border: 1px solid rgba(0,0,0,0.5);
        border-radius: 50%;
        position: relative;
        cursor: pointer;
        margin: 5px 10px;
    }

    #sidebar-stocks .custom-checkbox:after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 12px;
        height: 12px;
        background-color: maroon;
        transform: translate(-50%, -50%) scale(0);
        border-radius: 50%;
        transition: transform 0.2s ease;
    }

    #sidebar-stocks input[type="checkbox"]:checked + .custom-checkbox:after {
        transform: translate(-50%, -50%) scale(1);
    }

    #sidebar-stocks .category-label {
        display: flex;
        padding: 5px;
        align-items: center;
    }

    #sidebar-stocks .category-label .expand-icon {
        margin-right: 10px;
        font-size: 0.75rem;
        transition: transform 0.3s ease;
    }

    #sidebar-stocks .category-label.active .expand-icon {
        transform: rotate(180deg);
    }

    #sidebar-stocks select {
        font-size: 14px;
        padding: 5px;
        width: 100%;
        box-sizing: border-box;
        text-overflow: ellipsis;
        border-radius: 10px;
    }

    #sidebar-stocks select option {
        padding: 10px;
    }
</style>

<div class="container-fluid" id="sidebar-stocks">
    <div class="sidebar">
        <div class="header">
            <select id="filterSelect" class="form-control" style="width: 100%; padding: 5px;">
                <option value="">All</option>
                <option value="low">Low Stocks</option>
                <option value="high">High Stocks</option>
            </select>
        </div>
        <ul>
            <li class="category-label">
                <input type="checkbox" id="all" value="all" class="category-checkbox">
                <span class="custom-checkbox"></span>
                <label for="all">Select All</label>
            </li>
            <?php
            if ($cat_result->num_rows > 0) {
                while ($cat = $cat_result->fetch_assoc()) {
                    $category = ucfirst($cat['category']);
                    $value = $cat['category'];
                    echo '<li class="category-label">
                            <input type="checkbox" id="'. $value .'" value="'. $value .'" class="category-checkbox">';
                    echo    '<span class="custom-checkbox"></span>';
                    echo    '<label for="'. $value .'">'. $category .'</label>';

                    $subcat_result = $conn->query("SELECT DISTINCT sub_category FROM stocks WHERE category = '$value' AND sub_category IS NOT NULL");
                    if ($subcat_result->num_rows > 0) {
                        echo '<span class="expand-icon fas fa-chevron-down"></span>';
                        echo '<ul class="subcategory-dropdown">';
                        while ($subcat = $subcat_result->fetch_assoc()) {
                            $sub_category = ucfirst($subcat['sub_category']);
                            $sub_value = $subcat['sub_category'];
                            echo '<li class="subcategory-label">
                                    <input type="checkbox" id="'. $sub_value .'" value="'. $sub_value .'" class="subcategory-checkbox">';
                            echo    '<span class="custom-checkbox"></span>';
                            echo    '<label for="'. $sub_value .'">'. $sub_category .'</label>
                                </li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<span class="expand-icon"></span>';
                    }

                    echo '</li>';
                }
            } else {
                echo 'No category';
            }
            ?>
        </ul>
    </div>
    <div class="stock-container">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-3 sortable" data-sort="stockNo">Stock No.<i class="fas fa-sort sort-icon"></i></th>
                        <th class="col-6 sortable" data-sort="item">Item<i class="fas fa-sort sort-icon"></i></th>
                        <th class="col-1 text-center sortable" data-sort="unitPrice">Price<i class="fas fa-sort sort-icon"></i></th>
                        <th class="col-1 text-center sortable" data-sort="qty">Qty<i class="fas fa-sort sort-icon"></i></th>
                    </tr>
                </thead>
                <tbody id="stockTable">
                    <?php
                        if ($ss_result->num_rows > 0) {
                            while ($ss = $ss_result->fetch_assoc()) {
                                $stock_img = isset($ss['media']) ? 'data:image/png;base64,' . base64_encode($ss['media']) : 'img/default-user.png';
                                
                                echo '<tr data-category="'. $ss['category'] .'" data-sub-category="'. ($ss['scategory'] ? $ss['scategory'] : '') .'" style="cursor: pointer;" data-toggle="modal" data-target="#stock-card" data-value="'. $ss['stock_no'] .'">

                                        <td>' . $ss['stock_no'] . '</td>
                                        <td>
                                            <div class="row">
                                                <img src="'. $stock_img .'" class="img-tbl" alt="'. $ss['name'] .'"> ' . $ss['title'] . ' ' . ($ss['size'] != NULL ? '(' . $ss['size'] . ')' : '') . '
                                            </div>
                                        </td>
                                        <td class="text-center">₱ ' . number_format($ss['unit_price'], 2) . '</td>
                                        <td class="text-center">' . $ss['quantity'] . '</td>
                                    </tr>';
                            }
                        } else {
                            echo "No stocks found.";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/stock-card.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('#stockTable tr');
    const allCheckbox = document.getElementById('all');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox:not(#all)');
    const subcategoryCheckboxes = document.querySelectorAll('.subcategory-checkbox');
    const categoryListItems = document.querySelectorAll('.category-label');
    const expandIcons = document.querySelectorAll('.expand-icon');

    rows.forEach(row => {
        const qtyCell = row.querySelector('td:nth-child(4)');
        if (qtyCell) {
            const qty = parseInt(qtyCell.textContent, 10);
            if (qty <= 5) {
                row.classList.add('low-stock');
            }
        }
    });

    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', function() {
            const tableBody = document.querySelector('#stockTable');
            const rowsArray = Array.from(tableBody.querySelectorAll('tr'));
            const columnIndex = this.cellIndex;
            const isNumeric = columnIndex === 2 || columnIndex === 3;

            document.querySelectorAll('.sortable .sort-icon').forEach(icon => {
                icon.classList.remove('fa-sort-up', 'fa-sort-down');
                icon.classList.add('fa-sort');
            });
            document.querySelectorAll('.sortable').forEach(header => {
                header.classList.remove('sorted-header');
            });

            let sortOrder = this.dataset.sortOrder || 'asc';
            if (sortOrder === 'asc') {
                sortOrder = 'desc';
                this.querySelector('.sort-icon').classList.remove('fa-sort', 'fa-sort-up');
                this.querySelector('.sort-icon').classList.add('fa-sort-down');
            } else {
                sortOrder = 'asc';
                this.querySelector('.sort-icon').classList.remove('fa-sort', 'fa-sort-down');
                this.querySelector('.sort-icon').classList.add('fa-sort-up');
            }
            this.dataset.sortOrder = sortOrder;

            this.classList.add('sorted-header');

            rowsArray.sort((a, b) => {
                const cellA = a.cells[columnIndex].textContent.trim();
                const cellB = b.cells[columnIndex].textContent.trim();

                if (isNumeric) {
                    const valueA = parseFloat(cellA.replace(/[^\d.-]/g, ''));
                    const valueB = parseFloat(cellB.replace(/[^\d.-]/g, ''));
                    return sortOrder === 'asc' ? valueA - valueB : valueB - valueA;
                } else {
                    return sortOrder === 'asc' ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                }
            });

            rowsArray.forEach(row => tableBody.appendChild(row));
        });
    });

    document.getElementById('filterSelect').addEventListener('change', function() {
        const selectedFilter = this.value;
        filterStocks(selectedFilter);
    });

    allCheckbox.addEventListener('change', function() {
        categoryCheckboxes.forEach(checkbox => checkbox.checked = allCheckbox.checked);
        subcategoryCheckboxes.forEach(checkbox => checkbox.checked = allCheckbox.checked);
    });

    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                allCheckbox.checked = false;
            }
        });
    });

    subcategoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                allCheckbox.checked = false;
            }
        });
    });

    categoryListItems.forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

    expandIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('active');
            this.classList.toggle('fa-chevron-down');
            this.classList.toggle('fa-chevron-up');
        });
    });
});
</script>
