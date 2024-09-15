<style>
#salesContainer {
    display: flex;
    height: 90vh; 
    max-height: 800px; 
    overflow: hidden; 
    padding: 20px;
}

#salesContainer .left-container {
    width: 60%; 
    border-right: 1px solid maroon;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-y: auto; 
    overflow-x: hidden;
}

#salesContainer .right-container {
    width: 40%; 
    overflow-y: auto;
    padding-left: 20px;
}

#salesContainer .form-box {
    width: 100%;
    position: relative;
    padding-bottom: 60px; 
}

#salesContainer .form-box .header {
    position: sticky;
    top: 0;
    background: #fff;
    border-bottom: 2px solid #800000;
    padding: 10px;
    z-index: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#salesContainer .form-box .header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
}

#salesContainer .form-group {
    display: inline-block;
    margin-right: 15px;
    margin-bottom: 15px;
    vertical-align: top;
}

#salesContainer .form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
}

#salesContainer .form-group input, .form-group select {
    padding: 10px;
    border: 0.5px solid rgba(128, 5, 5, 0.4);
    border-radius: 10px;
    background-color: #FFFFFF;
    color: #000000;
    font-size: 0.8rem;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#salesContainer .form-group select {
    padding: 5px;
}

#salesContainer .form-group input::placeholder {
    opacity: 0.4;
    color: #800000;
}

#salesContainer .form-group input:focus, .form-group select:focus {
    outline: none;
    border-color: #800000;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.3);
}

#salesContainer .row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

#salesContainer button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    background-color: #800000;
    color: white;
}

#salesContainer .p {
    padding: 20px 15px 5px 5px;
}

#salesContainer button:hover {
    background-color: #1f1f1f;
}

.qty-fg {
    width: 11%;
}

.nm-fg {
    width: 20%;
}

.or-fg {
    width: 15%;
}

.r-fg {
    width: 20%;
}

#salesContainer .footer {
    position: sticky;
    bottom: 0;
    background: #fff;
    border-top: 2px solid #800000;
    padding: 10px;
    display: none;
    z-index: 1;
}
</style>

<div class="container-fluid" id="salesContainer">
    <div class="left-container">
        <div class="form-box">
            <div class="header mb-2">
                <h1>Data Entry</h1>
                <div class="p p-2">No. of Stocks : </div>
                <div class="form-group">
                    <input type="number" id="stockCount" name="stockCount" min="1" placeholder="Enter number of stocks">
                </div>
            </div>
            <form action="your-server-endpoint.php" method="post" id="salesForm">
                <div id="stocksFields"></div>
                <div class="footer" id="footer">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="right-container">
        <?php include 'records.php'; ?>
    </div>
</div>

<script>
    function generateRows() {
        const stockCount = parseInt(document.getElementById('stockCount').value) || 0;
        const stocksFields = document.getElementById('stocksFields');
        const footerContainer = document.getElementById('footer');
        stocksFields.innerHTML = '';

        for (let i = 0; i < stockCount; i++) {
            const fieldHtml = `
            <div class="row pl-4">
                <div class="p">${i + 1}.</div>
                <div class="form-group nm-fg">
                    <label for="itemName${i}">Item Name:</label>
                    <select class="form-control" id="itemName${i}" name="itemName${i}">
                        <option value="" disabled selected>Select an item</option>
                        <option value="item1">Item 1</option>
                        <option value="item2">Item 2</option>
                        <option value="item3">Item 3</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="form-group qty-fg">
                    <label for="itemQuantity${i}">Qty:</label>
                    <input type="number" class="form-control" id="itemQuantity${i}" name="itemQuantity${i}" min="1" required>
                </div>
                <div class="form-group or-fg">
                    <label for="orNumber${i}">OR-No.:</label>
                    <input type="text" class="form-control" id="orNumber${i}" name="orNumber${i}" maxlength="20" oninput="validateDigits(this)">
                </div>
                <div class="form-group dt-fg">
                    <label for="itemDate${i}">Date:</label>
                    <input type="date" class="form-control" id="itemDate${i}" name="itemDate${i}" required>
                </div>
                <div class="form-group r-fg">
                    <label for="itemRemarks${i}">Remarks:</label>
                    <input type="text" class="form-control" id="itemRemarks${i}" name="itemRemarks${i}" placeholder="Optional">
                </div>
                <div class="form-group name-fg pl-4">
                    <label for="firstName${i}">First Name:</label>
                    <input type="text" class="form-control" id="firstName${i}" name="firstName${i}" required placeholder="Enter first name">
                </div>
                <div class="form-group name-fg">
                    <label for="middleName${i}">Middle Name:</label>
                    <input type="text" class="form-control" id="middleName${i}" name="middleName${i}" placeholder="Optional">
                </div>
                <div class="form-group name-fg">
                    <label for="lastName${i}">Last Name:</label>
                    <input type="text" class="form-control" id="lastName${i}" name="lastName${i}" placeholder="Optional">
                </div>
                <div class="form-group name-fg">
                    <label for="suffix${i}">Suffix:</label>
                    <input type="text" class="form-control" id="suffix${i}" name="suffix${i}" placeholder="Optional">
                </div>
            </div>
            <hr>`;

            stocksFields.insertAdjacentHTML('beforeend', fieldHtml);

    if (stockCount > 0) {
            footerContainer.style.display = 'block'; 
        } else {
            footerContainer.style.display = 'none'; 
        }
        
        }
    }


    function validateDigits(input) {
        input.value = input.value.replace(/[^0-9]/g, ''); 
    }

    document.getElementById('stockCount').addEventListener('input', generateRows);
</script>
