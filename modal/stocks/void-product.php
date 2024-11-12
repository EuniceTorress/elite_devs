<div id="voidModal" class="void-modal">
    <div class="void-modal-content">
        <span class="material-icons void-close-btn" onclick="closeVModal()">close</span>
        <div class="void-modal-header">Void Product</div>
        <form id="voidForm" class="void-modal-body" onsubmit="submitVoid(event)">
            <div class="flex-row align-center">
                <div style="flex: 2;">
                    <label for="reason">Reason</label>
                    <select id="reason" class="void-select-field" onchange="handleReasonChange(); validateFields()" required>
                        <option value="" disabled>Select reason</option>
                        <option value="Damaged Item" selected>Damaged Item</option> 
                        <option value="Delete Item">Delete Item</option>
                        <option value="Update Price Quantity">Less Quantity</option>
                        <option value="Replace Category">Replace Category</option>
                    </select>
                </div>
                <div id="dateArrivedContainer" style="flex: 3;">
                    <label for="dateArrivedMonth">Date Arrived</label>
                    <div style="display: flex; gap: 8px;">
                        <select id="dateArrivedMonth" class="void-select-field" oninput="validateFields()">
                            <?php
                                $currentMonth = date("m");
                                $currentYear = date("Y");

                                $months = [
                                    "01" => "January", "02" => "February", "03" => "March", "04" => "April",
                                    "05" => "May", "06" => "June", "07" => "July", "08" => "August",
                                    "09" => "September", "10" => "October", "11" => "November", "12" => "December"
                                ];

                                foreach ($months as $value => $name) {
                                    $selected = ($value === $currentMonth) ? "selected" : "";
                                    if ($value <= $currentMonth) {
                                        echo "<option value='$value' $selected>$name</option>";
                                    }
                                }
                            ?>
                        </select>
                        <select id="dateArrivedYear" class="void-select-field" oninput="validateFields()">
                            <?php
                                $currentYear = date("Y");
                                echo "<option value='$currentYear' selected>$currentYear</option>";
                            ?>
                        </select>
                    </div>
                </div>
                <div id="activitySelectContainer" style="display: none;">
                    <label for="reasonText">Reason for Quantity Update</label>
                    <input type="text" id="reasonText" class="void-input-field" placeholder="Please specify" oninput="validateFields()" />
                </div>
                <div id="replaceCategoryContainer" style="display: none;">
                    <label for="categorySelect">Category</label>
                    <select id="categorySelect" class="void-select-field" onchange="handleCategoryChange(); validateFields()">
                        <option value="" disabled selected>Select category</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div>
            <div class="flex-row">
                <div style="flex: 3;">
                    <input type="text" id="otherCategoryInput" class="void-input-field mb-2" placeholder="Specify other category" style="display: none;" oninput="validateFields()" />
                    <label for="itemName">Item Name</label>
                    <input type="text" id="itemName" class="void-input-field vsf1" oninput="suggestItems(); validateFields()" placeholder="Search item" required>
                    <div id="itemSuggestions" class="suggestions-list"></div>
                </div>
                <div style="flex: 1;" id="quantityContainer" style="display: none;">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" class="void-input-field" min="1" oninput="validateQuantity(); validateFields()" />
                    <span id="maxQuantityNote" style="font-size: 12px; color: red; display: none;"></span>
                </div>
            </div>

            <div class="void-modal-footer">
                <button type="submit" id="submitBtn" class="void-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
const itemQuantities = {};

document.getElementById("voidProduct").onclick = function() {
    fetchItems(); 
    openVModal(); 
};

function openVModal() {
    const modal = document.getElementById("voidModal");
    modal.classList.add("show");
    resetModalFields(); 
}

function closeVModal() {
    const modal = document.getElementById("voidModal");
    modal.classList.remove("show");
    resetModalFields(); 
}

function resetModalFields() {
    document.getElementById("itemName").value = "";
    document.getElementById("quantity").value = "";
    document.getElementById("reason").value = "";
    document.getElementById("maxQuantityNote").style.display = "none";
    document.getElementById("itemSuggestions").innerHTML = "";
    document.getElementById("dateArrived").value = "";
    document.getElementById("reasonText").value = "";
}

function fetchItems() {
    const apiUrl = '../../sql/fetch/stock-void.php';  

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json(); 
        })
        .then(data => {
            console.log(data);  
            if (Array.isArray(data)) {
                data.forEach(item => {
                    itemQuantities[item.name] = { stock_no: item.stock_no, qty: parseInt(item.qty, 10) };
                });
            } else {
                console.error("Expected an array of items, but got:", data);
            }
        })
        .catch(error => {
            console.error('Error fetching items:', error);
        });
}

function suggestItems() {
    const input = document.getElementById("itemName").value.toLowerCase();
    const suggestionsDiv = document.getElementById("itemSuggestions");
    suggestionsDiv.innerHTML = ""; 

    if (input) {
        Object.keys(itemQuantities).forEach(name => {
            if (name.toLowerCase().includes(input)) {
                const suggestion = document.createElement("div");
                suggestion.classList.add("suggestion-item");
                suggestion.textContent = name;
                suggestion.onclick = () => selectItem(name);
                suggestionsDiv.appendChild(suggestion);
            }
        });
    }
}

function selectItem(name) {
    document.getElementById("itemName").value = name;
    document.getElementById("itemSuggestions").innerHTML = "";
    updateMaxQuantity();  
    validateFields();  
}

function updateMaxQuantity() {
    const itemName = document.getElementById("itemName").value;
    const maxQuantity = itemQuantities[itemName]?.qty || 1;
    const quantityInput = document.getElementById("quantity");
    const maxQuantityNote = document.getElementById("maxQuantityNote");

    quantityInput.value = ""; 
    quantityInput.max = maxQuantity;  
    maxQuantityNote.style.display = maxQuantity ? "none" : ''; 
    validateFields();
}

function validateQuantity() {
    const itemName = document.getElementById("itemName").value;
    const quantity = parseInt(document.getElementById("quantity").value, 10);
    const maxQuantity = itemQuantities[itemName]?.qty || 1;
    const maxQuantityNote = document.getElementById("maxQuantityNote");

    if (quantity > maxQuantity) {
        maxQuantityNote.textContent = `Quantity exceeds available stock (${maxQuantity}).`;
        maxQuantityNote.style.display = "block"; 
    } else {
        maxQuantityNote.style.display = "none";  
        validateFields();  
    }
}

function handleReasonChange() {
    const reasonSelect = document.getElementById("reason").value;
    const quantityContainer = document.getElementById("quantityContainer");
    const dateArrivedContainer = document.getElementById("dateArrivedContainer");
    const activitySelectContainer = document.getElementById("activitySelectContainer");
    const replaceCategoryContainer = document.getElementById("replaceCategoryContainer");

    quantityContainer.style.display = (reasonSelect === "Update Price Quantity" || reasonSelect === "Damaged Item") ? "block" : "none";
    dateArrivedContainer.style.display = (reasonSelect === "Damaged Item") ? "block" : "none";
    activitySelectContainer.style.display = (reasonSelect === "Update Price Quantity") ? "block" : "none";
    replaceCategoryContainer.style.display = (reasonSelect === "Replace Category") ? "block" : "none";

    validateFields();
}

function validateFields() {
    const itemName = document.getElementById("itemName").value.trim();
    const reason = document.getElementById("reason").value;
    const quantity = document.getElementById("quantity").value;
    const dateArrivedMonth = document.getElementById("dateArrivedMonth").value;
    const dateArrivedYear = document.getElementById("dateArrivedYear").value;
    const submitBtn = document.getElementById("submitBtn");
    const today = new Date();
    const selectedDate = new Date(dateArrivedYear, dateArrivedMonth - 1);

    const isValid = itemName && reason && (quantity || reason !== "Damaged Item");
    submitBtn.disabled = !isValid || selectedDate > today;
}

function submitVoid(event) {
    event.preventDefault();

    const itemName = document.getElementById("itemName").value;
    const reason = document.getElementById("reason").value;
    const quantity = parseInt(document.getElementById("quantity").value, 10) || null;
    const dateArrivedMonth = document.getElementById("dateArrivedMonth").value;
    const dateArrivedYear = document.getElementById("dateArrivedYear").value;
    const latestActivity = document.getElementById("reasonText").value || null;
    const category = document.getElementById("categorySelect").value || null;
    const otherCategory = document.getElementById("otherCategoryInput").value || null;

    console.log("Submitting data:", {
        itemName,
        reason,
        quantity,
        dateArrivedMonth,
        dateArrivedYear,
        latestActivity,
        category,
        otherCategory
    });

    const requestData = {
        itemName,
        reason,
        quantity,
        dateArrivedMonth,  
        dateArrivedYear, 
        latestActivity,
        category,
        otherCategory
    };

    let apiUrl;
    switch (reason) {
        case "Damaged Item":
            apiUrl = '../../sql/insert/stock-void.php';
            break;
        case "Delete Item":
            apiUrl = '../../sql/delete/stock-void.php';
            break;
        case "Update Price Quantity":
            apiUrl = '../../sql/void-update-quantity.php';
            break;
        case "Replace Category":
            apiUrl = '../../sql/void-replace-category.php';
            break;
        default:
            alert("Invalid reason selected.");
            return;
    }

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            showMessage(data.success || "Submission successful");
            fetchData();
            closeVModal();
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
}

</script>
