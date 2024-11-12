<?php
include '../../modal/stocks/add-stocks.php';
include '../../modal/stocks/edit-stock.php';
include '../../modal/stocks/update-photo.php';
include '../../modal/stocks/void-product.php';
include '../../modal/stocks/print-modal.php';
?>
<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-2" data-sort="id">
          ID <i class="material-icons sort-icon" id="id-sort-icon">arrow_upward</i>
        </th>
        <th class="col-4" data-sort="name">
          Stock Name <i class="material-icons sort-icon" id="name-sort-icon">arrow_upward</i>
        </th>
        <th class="col-2" data-sort="category" id="category-header">
          Category <span class="material-icons filter-icon">filter_list</span>
          <div id="category-dropdown" class="dropdown">
            <div class="dropdown-content" id="dropdown-content"></div>
          </div>
        </th>
        <th class="col-1" data-sort="unit_cost" id="cost-header">
          Cost <span class="material-icons filter-icon">filter_list</span>
          <div id="cost-dropdown" class="dropdown">
            <div class="dropdown-content" id="cost-dropdown-content">
              <input type="number" id="min-cost" placeholder="Min" step="0.01">
              <input type="number" id="max-cost" placeholder="Max" step="0.01">
              <div class="-btn-wrapper">
                <button id="clear-cost" class="btn">
                    <span class="material-icons">delete</span>
                </button>
                <button id="apply-cost" class="btn">
                    <span class="material-icons">check</span>
                </button>
              </div>
            </div>
          </div>
        </th>
        <th class="col-1" data-sort="unit_price" id="price-header">
          Price <span class="material-icons filter-icon">filter_list</span>
          <div id="price-dropdown" class="dropdown">
            <div class="dropdown-content" id="price-dropdown-content">
              <input type="number" id="min-price" placeholder="Min" step="0.01">
              <input type="number" id="max-price" placeholder="Max" step="0.01">
              <div class="p-btn-wrapper">
                <button id="clear-price" class="btn">
                    <span class="material-icons">delete</span>
                </button>
                <button id="apply-price" class="btn">
                    <span class="material-icons">check</span>
                </button>
              </div>
            </div>
          </div>
        </th>
        <th class="col-1" data-sort="rqty">Qty 
          <!-- <i class="material-icons sort-icon" id="quantity-sort-icon">arrow_upward</i> -->
        </th>
      </tr>
    </thead>
    <tbody id="table-body"></tbody>
  </table>
</div>

<?php
include '../../src/js/tables/inventory/filter.php';
?>