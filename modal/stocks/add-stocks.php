<?php include '../../src/css/modal/add-stock.php'; ?>

<div id="newArrivalModal" class="modal">
    <div class="modal-body">
        <div class="modal-header">
            <h5 class="col-7">New Arrival</h5>

            <p class="p-1">Category:</p>
            <select class="form-control" id="mainCategory" name="mainCategory" style="margin: 0;">
                <option value="">Select Category</option>
            </select>

            <div id="additionalCategoryField" style="display: none;">
                <input type="text" class="form-control" id="otherCategory" name="otherCategory" placeholder="Specify Type">
            </div>

            <p class="p-1">No. of Stocks:</p>
            <input type="number" class="form-control" id="stockCount" name="stockCount" min="1" required>

            <button type="button" id="closeModal" class="close-btn">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-content">
            <form id="stocksForm" action="../../sql/insert/add-stocks.php" method="POST" enctype="multipart/form-data">
                <div id="stocksFields"></div>
                <input type="hidden" id="formStockCount" name="stockCount">
            </form>
        </div>

        <div class="modal-footer">
            <p><?php echo date('Y-m-d') . ' <span id="time">' . date('H:i:s') . '</span>'; ?></p>
            <button type="button" id="submitBtn" class="btn btn-success">Submit</button>
        </div>
    </div>
</div>

<script src="../../src/js/modal/new-arrival/modal.js"></script>
<script src="../../src/js/modal/new-arrival/populate-category.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const stockCountInput = document.getElementById('stockCount');
    const stocksFieldsContainer = document.getElementById('stocksFields');
    const mainCategory = document.getElementById('mainCategory');
    const additionalCategoryField = document.getElementById('additionalCategoryField');
    const submitButton = document.getElementById('submitBtn');

    async function fetchCategories(endpoint) {
        const response = await fetch(endpoint);
        return await response.json();
    }

    fetchCategories('../../sql/fetch/stock-category.php').then(categories => {
        if (categories.length > 0) {
            mainCategory.innerHTML = categories.map(cat => 
                `<option value="${cat}">${cat.charAt(0).toUpperCase() + cat.slice(1)}</option>`
            ).join('') + `<option value="others">Others</option>`;
        } else {
            mainCategory.innerHTML = `<option value="others" selected>Others</option>`;
            additionalCategoryField.style.display = 'block';
        }
    });

    mainCategory.addEventListener('change', () => {
        additionalCategoryField.style.display = mainCategory.value === 'others' ? 'block' : 'none';
    });

    function updateFields() {
        const count = parseInt(stockCountInput.value) || 0;
        stocksFieldsContainer.innerHTML = '';  

        for (let i = 0; i < count; i++) {
            const fieldHtml = `
            <div class="stock-field">
                <div class="row">
                    <p class="lb">${i + 1}.</p>
                    <div class="form-group col-2">
                        <label for="itemName${i}">Item Name:</label>
                        <input type="text" class="form-control" id="itemName${i}" name="itemName${i}" placeholder="Enter item name" required>
                    </div>
                    <div class="form-group col-2">
                        <label for="itemUnit${i}">Unit:</label>
                        <input type="text" class="form-control" id="itemUnit${i}" name="itemUnit${i}" placeholder="e.g., kg, pcs" required>
                    </div>
                    <div class="form-group col-2">
                        <label for="toggleDescription${i}" style="display: inline-flex; align-items: center;">
                            <input type="checkbox" id="toggleDescription${i}" class="toggle-field" style="margin-right: 5px;">
                            Description 1
                        </label>
                        <div id="itemDescriptionField${i}" style="display: none;">
                            <input type="text" class="form-control" id="itemDescription${i}" name="itemDescription${i}" placeholder="Optional">
                        </div>
                    </div>
                    <div class="form-group col-2">
                        <label for="toggleSize${i}" style="display: inline-flex; align-items: center;">
                            <input type="checkbox" id="toggleSize${i}" class="toggle-field" style="margin-right: 5px;">
                            Description 2
                        </label>
                        <div id="itemSizeField${i}" style="display: none;">
                            <input type="text" class="form-control" id="itemSize${i}" name="itemSize${i}" placeholder="Optional">
                        </div>
                    </div>
                    <div class="form-group col-1">
                        <label for="itemQuantity${i}">Quantity:</label>
                        <input type="number" class="form-control" id="itemQuantity${i}" name="itemQuantity${i}" min="1" required>
                    </div>
                    <div class="form-group col-1">
                        <label for="itemCost${i}">Cost:</label>
                        <input type="number" step="0.01" class="form-control" id="itemCost${i}" name="itemCost${i}" min="1" required>
                    </div>
                    <div class="form-group col-1">
                        <label for="itemPrice${i}">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="itemPrice${i}" name="itemPrice${i}" min="1" required>
                    </div>
                </div>
                <hr>
            </div>
            `;
            stocksFieldsContainer.insertAdjacentHTML('beforeend', fieldHtml);

            document.getElementById(`toggleDescription${i}`).addEventListener('change', function() {
                document.getElementById(`itemDescriptionField${i}`).style.display = this.checked ? 'block' : 'none';
            });

            document.getElementById(`toggleSize${i}`).addEventListener('change', function() {
                document.getElementById(`itemSizeField${i}`).style.display = this.checked ? 'block' : 'none';
            });
        }
    }

    stockCountInput.addEventListener('input', updateFields);  

    submitButton.addEventListener('click', async (event) => {
        event.preventDefault();
        const form = document.getElementById('stocksForm');
        const formData = new FormData(form);  

        const stockCount = parseInt(stockCountInput.value) || 0;
        let isValid = true;
        const errorMessage = document.getElementById('error-message');
        
        for (let i = 0; i < stockCount; i++) {
            const itemName = document.getElementById(`itemName${i}`).value.trim();
            const itemCategory = mainCategory.value;
            const otherCategory = document.getElementById('otherCategory').value.trim();
            const quantity = parseInt(document.getElementById(`itemQuantity${i}`).value) || 0;
            const unitPrice = parseFloat(document.getElementById(`itemPrice${i}`).value) || 0.00;
            const unitCost = parseFloat(document.getElementById(`itemCost${i}`).value) || 0.00;

            if (!itemName || quantity <= 0 || unitPrice <= 0 || unitCost <= 0) {
                isValid = false;
                errorMessage.textContent = `Please fill all required fields for item ${i + 1}.`;
                break;
            }

            if (itemCategory === 'others' && (!otherCategory || !itemCategory)) {
                isValid = false;
                errorMessage.textContent = `Please specify the type for item ${i + 1}.`;
                break;
            }

            if (unitPrice <= unitCost) {
                isValid = false;
                errorMessage.textContent = `Price cannot be less than or equal to cost for item ${i + 1}.`;
                break;
            }
        }

        if (isValid) {
            try {
                formData.append('mainCategory', mainCategory.value);
                formData.append('otherCategory', document.getElementById('otherCategory').value);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    showMessage("Stock successfully added!");
                    form.reset();
                    updateFields();  
                } else {
                    showMessage("Failed to add stock.");
                }
            } catch (error) {
                console.error("Error during form submission:", error);
                showMessage("There was an error submitting the form.");
            }
        }

        

    fetchData();

    });
});

function resetAllInputs(stockCount) {
    for (let i = 0; i < stockCount; i++) {
        const itemNameInput = document.getElementById(`itemName${i}`);
        if (itemNameInput) itemNameInput.value = '';

        const itemDescriptionInput = document.getElementById(`itemDescription${i}`);
        if (itemDescriptionInput) itemDescriptionInput.value = '';

        const itemSizeInput = document.getElementById(`itemSize${i}`);
        if (itemSizeInput) itemSizeInput.value = '';

        const itemCategorySelect = document.getElementById(`itemCategory${i}`);
        if (itemCategorySelect) itemCategorySelect.value = 'electronics'; 

        const otherCategoryInput = document.getElementById(`otherCategory${i}`);
        if (otherCategoryInput) otherCategoryInput.value = '';

        const itemQuantityInput = document.getElementById(`itemQuantity${i}`);
        if (itemQuantityInput) itemQuantityInput.value = '';

        const itemPriceInput = document.getElementById(`itemPrice${i}`);
        if (itemPriceInput) itemPriceInput.value = '';

        const itemCostInput = document.getElementById(`itemCost${i}`);
        if (itemCostInput) itemCostInput.value = '';

        const toggleDescriptionInput = document.getElementById(`toggleDescription${i}`);
        if (toggleDescriptionInput) toggleDescriptionInput.checked = false;
        const itemDescriptionField = document.getElementById(`itemDescriptionField${i}`);
        if (itemDescriptionField) itemDescriptionField.style.display = 'none';

        const toggleSizeInput = document.getElementById(`toggleSize${i}`);
        if (toggleSizeInput) toggleSizeInput.checked = false;
        const itemSizeField = document.getElementById(`itemSizeField${i}`);
        if (itemSizeField) itemSizeField.style.display = 'none';
    }
}

</script>
