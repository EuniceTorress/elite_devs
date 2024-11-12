<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <form id="salesForm" style="flex: 2; max-width: 600px;">
     <div id="message" class="success-message"></div>

        <div class="form-group-inline sd-bdy">
            <div class="form-group col-3">
                <label for="orNumber">OR No.:</label>
                <input type="text" class="form-control" id="orNumber" name="orNumber" maxlength="20" oninput="validateDigits(this)" required>
            </div>
            <div class="form-group col-2">
                <label for="itemCount">Items qty:</label>
                <input type="number" class="form-control" id="itemCount" name="itemCount" min="1" required>
            </div>
            <div class="form-group col-3">
                <label for="itemDate">Date:</label>
                <input type="date" class="form-control" id="itemDate" name="itemDate" required>
            </div>
            <div class="form-group col-3">
                <label for="customerType">Name Type:</label>
                <select class="form-control customer-type" id="customerType" name="customerType">
                    <option value="name">Full Name</option>
                    <option value="nickname">Nickname</option>
                    <option value="org">Organization Name</option>
                </select>
            </div>
        </div>
        
        <div id="customerFields" class="customer-fields"></div>
        <div id="itemFields"></div>

        <div id="footer">
            <button type="submit">Submit</button>
        </div>
    </form>

    <div id="recentSales" style="flex: 1; border: 1px solid #ccc; padding: 10px; overflow-y: auto;">
        <div class="d-flex"><h3>Recent Sales</h3><a href="./body.php?sales-2" id="view-all">View All</a></div>
        <div id="salesList"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const customerType = document.getElementById('customerType');
    const customerFields = document.getElementById('customerFields');
    const itemFields = document.getElementById('itemFields');
    const itemCountInput = document.getElementById('itemCount');
    const salesList = document.getElementById('salesList');
    const messageDiv = document.getElementById('message');
    const itemDate = document.getElementById('itemDate');

    itemDate.value = new Date().toISOString().split('T')[0];

    let items = [];
    try {
        const response = await fetch('../../sql/fetch/sales-item.php');
        items = await response.json();
    } catch (error) {
        console.error('Error fetching items:', error);
    }

    const generateCustomerFields = (type) => {
        customerFields.innerHTML = '';
        if (type === 'name') {
            customerFields.innerHTML = `
                <div class="form-group-inline fg-col">
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" required>
                    </div>
                    <div class="form-group">
                        <label>First Name:</label>
                        <input type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Middle Name:</label>
                        <input type="text">
                    </div>
                    <div class="form-group">
                        <label>Suffix:</label>
                        <input type="text" placeholder="e.g., Jr., Sr., III">
                    </div>
                </div>
            `;
        } else if (type === 'nickname') {
            customerFields.innerHTML = `
                <div class="form-group col-12">
                    <label>Nickname:</label>
                    <input type="text" required>
                </div>
            `;
        } else if (type === 'org') {
            customerFields.innerHTML = `
                <div class="form-group col-12">
                    <label>Organization Name:</label>
                    <input type="text" required>
                </div>
            `;
        }
    };

    customerType.addEventListener('change', () => generateCustomerFields(customerType.value));
    generateCustomerFields(customerType.value);

    const generateItemRows = () => {
        const itemCount = parseInt(itemCountInput.value) || 0;
        itemFields.innerHTML = '';

        for (let j = 0; j < itemCount; j++) {
            itemFields.innerHTML += `
                <div class="item-row form-group-inline">
                    <div class="form-group inm-fg">
                        <label>Item ${j + 1}:</label>
                        <select required>
                            <option value="" disabled selected>Select an item</option>
                            ${items.map(item => `<option value="${item.name}">${item.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="form-group qty-fg">
                        <label>Quantity:</label><input type="number" min="1" required>
                    </div>
                    <div class="form-group r-fg">
                        <label>Remarks:</label><input type="text" placeholder="Optional">
                    </div>
                </div>
            `;
        }
    };

    itemCountInput.addEventListener('input', generateItemRows);
    document.getElementById('salesForm').addEventListener('submit', function(event) {
    event.preventDefault();  
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;  

    const formData = new FormData();
    const orNumber = document.getElementById('orNumber').value;
    const date = itemDate.value;
    const customerTypeValue = customerType.value;
    const customerTypeText = customerType.options[customerType.selectedIndex].text;
    const stockCount = itemCountInput.value;

    formData.append('orNumber', orNumber);
    formData.append('itemDate', date);
    formData.append('customerType', customerTypeValue);
    formData.append('stockCount', stockCount);

    customerFields.querySelectorAll('input').forEach((input, index) => {
        formData.append(`customerField${index}`, input.value);
    });

    const itemDetails = [];
    itemFields.querySelectorAll('.item-row').forEach((row, index) => {
        const itemName = row.querySelector('.inm-fg select').value;
        const itemQuantity = row.querySelector('.qty-fg input').value;
        const itemRemarks = row.querySelector('.r-fg input').value;
        formData.append(`itemName${index}`, itemName);
        formData.append(`itemQuantity${index}`, itemQuantity);
        formData.append(`itemRemarks${index}`, itemRemarks);
        itemDetails.push({ item: itemName, quantity: itemQuantity, remarks: itemRemarks });
    });

    fetch('../../sql/insert/sales.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(responseData => {
        const messageDiv = document.getElementById('message'); 
        if (responseData.status === 'success') {
            messageDiv.textContent = responseData.message;
            messageDiv.classList.add('visible', 'success-message');

            setTimeout(() => {
                messageDiv.classList.remove('visible');
                messageDiv.textContent = '';
            }, 3000);

            const saleEntry = document.createElement('div');
            saleEntry.className = 'sale-entry';
            saleEntry.innerHTML = `
                <p><strong>OR No.:</strong> ${orNumber}</p>
                <p><strong>Date:</strong> ${date}</p>
                <p><strong>Customer Type:</strong> ${customerTypeText}</p>
                <ul>
                    ${itemDetails.map(detail => `<li>${detail.item} - Qty: ${detail.quantity}, Remarks: ${detail.remarks}</li>`).join('')}
                </ul>
                <hr>
            `;
            salesList.prepend(saleEntry);

            document.getElementById('salesForm').reset();
            itemDate.value = new Date().toISOString().split('T')[0];
            generateCustomerFields(customerType.value);
            itemFields.innerHTML = '';
        } else {
            messageDiv.textContent = responseData.message;
            messageDiv.classList.add('visible', 'error-message');
            
            setTimeout(() => {
                messageDiv.classList.remove('visible');
                messageDiv.textContent = '';
            }, 3000);
        }

        submitButton.disabled = false;  
    })
    .catch(error => {
        console.error('Error submitting data:', error);

        submitButton.disabled = false;  

        const messageDiv = document.getElementById('message');
        messageDiv.textContent = 'There was an error submitting your form. Please try again later.';
        messageDiv.classList.add('visible', 'error-message');

        setTimeout(() => {
            messageDiv.classList.remove('visible');
            messageDiv.textContent = '';
        }, 3000);
    });
});

});

</script>
