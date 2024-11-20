
<style>
   
    #salesForm, #recentSales {
        padding: 25px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: #333;
    }


    #salesFormHeader {
        background-color: maroon;
        color: white;
        padding: 10px;
        text-align: center;
        font-size: 1.5rem;
        border-radius: 8px 8px 0 0;
    }

    #salesForm > div:first-child {
        margin-bottom: 50px;
    }

    #salesForm label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .noo {
        display: flex;
        flex-direction: row;
        padding: 0;
        margin: 0;
        position: relative;
        align-content: center;
        align-items: center;
    }

    #orCount {
        width: 7%;
        margin-left: -40px;
        margin-top: -12px;
    }

    #salesForm input[type="number"],
    #salesForm input[type="text"],
    #salesForm input[type="date"],
    #salesForm select {
        border-radius: 10px;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        font-size: 0.8rem;
        caret-color: maroon;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        outline: none;
        box-shadow: none !important;
    }

    .qty-fg {
        width: 25%;
    }

    .qty-fg input {
        width: 100%;
    }

    .fg-col input {
        width: 100%;
    }
.success-message, .error-message {
    display: none;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    font-size: 14px;
    width: 100%;
}

.success-message.visible, .error-message.visible {
    display: block;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

    #itemFields {
        overflow-y: auto;
        height: 39vh;
    }

    #salesForm input[type="number"]:focus,
    #salesForm input[type="text"]:focus,
    #salesForm input[type="date"]:focus,
    #salesForm select:focus {
        border-color: maroon;
        box-shadow: 0 0 5px rgba(128, 0, 0, 0.2);
        outline: none;
    }

    .form-group.col-12 input {
        width: 100%;
    }

    .or-section h5 {
        margin-top: 0;
        color: maroon;
        position: absolute;
        top: 5px;
        left: 5px;
        font-size: 0.9rem;
    }

    .form-group-inline {
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .item-row {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .customer-fields .form-group {
        margin-bottom: 15px;
    }

    #footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    #footer button {
        height: 35px;
        width: 100px;
        border-radius: 5px;
        text-align: center;
        font-size: 0.8rem;
        align-content: center;
        justify-content: center;
        align-items: center;
        color: #fff;
        background-color: rgba(57, 153, 24, 1);
        border: 1px solid rgba(54, 153, 24, 1);
        outline: none !important;
        transition: background-color 0.3s ease, color 0.3s ease, border 0.3s ease;
        box-shadow: none !important;
    }

    #footer button:hover {
        border: 1px solid rgba(54, 153, 24, 1);
        background-color: rgba(54, 153, 24, 0.2);
        color: rgba(54, 153, 24, 1);
    }

    #footer-2 {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    #footer-2 button {
    height: 35px;
    width: 100px;
    border-radius: 5px;
    text-align: center;
    font-size: 0.8rem;
    align-content: center;
    justify-content: center;
    align-items: center;
    color: #fff; 
    background-color: #008CBA; 
    border: 1px solid #008CBA; 
    outline: none !important;
    transition: background-color 0.3s ease, color 0.3s ease, border 0.3s ease;
    box-shadow: none !important;
}

#footer-2 button:hover {
    border: 1px solid #008CBA; 
    background-color: rgba(0, 140, 186, 0.2); 
    color: #008CBA; 
}


    #message {
        display: none;
        font-weight: bold;
        margin-top: 15px;
        padding: 10px;
        border-radius: 5px;
    }

    #message.success { 
        color: #28a745;
        background-color: #e6ffed;
        border: 1px solid #28a745;
    }

    #message.error {
        color: #dc3545; 
        background-color: #ffe6e6;
        border: 1px solid #dc3545;
    }

.sale-entry {
    background-color: #ffffff;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sale-entry:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.sale-entry .sale-details {
    font-family: 'Arial', sans-serif;
    color: #333;
}

.sale-entry .sale-details p {
    margin: 8px 0;
    font-size: 1rem;
    color: #333;
}

.sale-entry .sale-details p strong {
    color: #555;
    font-weight: 600;
}

.sale-entry ul {
    list-style-type: none;
    padding: 0;
    margin: 10px 0;
}

.sale-entry ul li {
    font-size: 0.9rem;
    color: #555;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.sale-entry .sale-details .item-details {
    padding: 10px;
    background-color: #f8f8f8;
    border-radius: 6px;
    margin-top: 10px;
    border: 1px solid #ddd;
}

.sale-entry .sale-details .item-details ul {
    margin: 0;
}

.sale-entry .sale-details .item-details ul li {
    border-bottom: 1px solid #e0e0e0;
}

.sale-entry .sale-details .item-details ul li:last-child {
    border-bottom: none;
}

.sale-entry-header {
    font-size: 1.2rem;
    font-weight: bold;
    color: maroon;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
}

.sale-entry-header span {
    font-size: 0.9rem;
    color: #888;
}

#salesList {
    margin-top: 15px;
}

#recentSales {  
    overflow-y: auto; 
    height: 700px; 
}

#recentSalesHeader {
        background-color: maroon;
        color: white;
        padding: 10px;
        text-align: center;
        font-size: 1.5rem;
        border-radius: 8px 8px 0 0;
    }


    @media (max-width: 768px) {
        .form-group-inline, .item-row {
            flex-direction: column;
        }

        .inm-fg, .qty-fg, .dt-fg, .r-fg {
            min-width: 100%;
        }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <form id="salesForm" style="flex: 2; max-width: 800px;">
    <div id="salesFormHeader">Sales Entry Form</div>
     <div id="message" class="success-message"></div>

        <div class="form-group-inline sd-bdy">
            <div class="form-group col-3">
                <label for="orNumber">OR No.:</label>
                <input type="text" class="form-control" id="orNumber" name="orNumber" value="12345" maxlength="20" oninput="validateDigits(this)" required>
            </div>
            <div class="form-group col-2">
                <label for="itemCount">Items qty:</label>
                <input type="number" class="form-control" id="itemCount" name="itemCount" value="2" min="1" required>
            </div>
            <div class="form-group col-3">
                <label for="itemDate">Date:</label>
                <input type="date" class="form-control" id="itemDate" name="itemDate" value="2024-11-19" required>
            </div>
            <div class="form-group col-3">
                <label for="customerType">Name Type:</label>
                <select class="form-control customer-type" id="customerType" name="customerType">
                    <option value="name" selected>Full Name</option>
                    <option value="nickname">Nickname</option>
                    <option value="org">Organization Name</option>
                </select>
            </div>
        </div>
        
        <div id="customerFields" class="customer-fields">
            <div class="form-group-inline fg-col">
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" value="Doe" required>
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" value="John" required>
                </div>
                <div class="form-group">
                    <label>Middle Name:</label>
                    <input type="text" value="M" >
                </div>
                <div class="form-group">
                    <label>Suffix:</label>
                    <input type="text" placeholder="e.g., Jr., Sr., III" value="Jr." >
                </div>
            </div>
        </div>
        
        <div id="itemFields">
            <div class="item-row form-group-inline">
                <div class="form-group inm-fg">
                    <label>Item 1:</label>
                    <select required>
                        <option value="Item A" selected>Item A</option>
                        <option value="Item B">Item B</option>
                    </select>
                </div>
                <div class="form-group qty-fg">
                    <label>Quantity:</label>
                    <input type="number" value="5" min="1" required>
                </div>
                <div class="form-group r-fg">
                    <label>Remarks:</label>
                    <input type="text" placeholder="Optional" value="Special request" >
                </div>
            </div>
            <div class="item-row form-group-inline">
                <div class="form-group inm-fg">
                    <label>Item 2:</label>
                    <select required>
                        <option value="Item A">Item A</option>
                        <option value="Item B" selected>Item B</option>
                    </select>
                </div>
                <div class="form-group qty-fg">
                    <label>Quantity:</label>
                    <input type="number" value="3" min="1" required>
                </div>
                <div class="form-group r-fg">
                    <label>Remarks:</label>
                    <input type="text" placeholder="Optional" value="Urgent delivery" >
                </div>
            </div>
        </div>

        <div id="footer">
            <button type="submit">Submit</button>
        </div>
    </form>

    <div id="recentSales" style="flex: 1; border: 1px solid #ccc; padding: 10px; overflow-y: auto; max-width: 600px;">
        <div id="recentSalesHeader">Recent Sales</div>
        <div id="salesList"></div>

        <div id="footer-2">
            <button id="view-all" onclick="window.location.href='./body.php?sales-2'">View All</button>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', async () => {
    const customerType = document.getElementById('customerType');
    const customerFields = document.getElementById('customerFields');
    const itemFields = document.getElementById('itemFields');
    const itemCountInput = document.getElementById('itemCount');
    const salesList = document.getElementById('salesList');
    const messageDiv = document.getElementById('message');
    const itemDate = document.getElementById('itemDate');
    const orNumberInput = document.getElementById('orNumber');
    
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
        const orNumber = orNumberInput.value;
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

        
setTimeout(() => {
    const responseData = {
        status: 'success',
        message: 'Sale recorded successfully!',
    };

    if (responseData.status === 'success') {
        messageDiv.textContent = responseData.message;
        messageDiv.classList.add('visible', 'success-message');

        setTimeout(() => {
            messageDiv.classList.remove('visible');
            messageDiv.textContent = '';
        }, 3000);

        const saleEntry = document.createElement('div');
        saleEntry.className = 'sale-entry';

        const saleHeader = document.createElement('div');
        saleHeader.className = 'sale-entry-header';
        saleHeader.innerHTML = `
            <span><strong>OR No.:</strong> ${orNumber}</span>
            <span><strong>Date:</strong> ${date}</span>
        `;
        saleEntry.appendChild(saleHeader);

        
        const customerDetails = document.createElement('div');
        customerDetails.className = 'sale-details';
        customerDetails.innerHTML = `
            <p><strong>Customer Type:</strong> ${customerTypeText}</p>
        `;
        saleEntry.appendChild(customerDetails);

        const itemDetailsContainer = document.createElement('div');
        itemDetailsContainer.className = 'item-details';

        const itemDetailsTable = document.createElement('table');
        itemDetailsTable.className = 'table table-bordered';
        const tableHeader = document.createElement('thead');
        tableHeader.innerHTML = `
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Remarks</th>
            </tr>
        `;
        itemDetailsTable.appendChild(tableHeader);

        const tableBody = document.createElement('tbody');

        itemDetails.forEach(detail => {
            const tableRow = document.createElement('tr');
            tableRow.innerHTML = `
                <td>${detail.item}</td>
                <td>${detail.quantity}</td>
                <td>${detail.remarks || 'N/A'}</td>
            `;
            tableBody.appendChild(tableRow);
        });

        itemDetailsTable.appendChild(tableBody);
        itemDetailsContainer.appendChild(itemDetailsTable);
        saleEntry.appendChild(itemDetailsContainer);

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
}, 1000); 

d
    });
});
</script>
