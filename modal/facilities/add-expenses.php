<div id="expensesModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Expenses</h5>
            <p class="lb text-right">No. to input :</p>
            <input type="number" id="expensesCount" name="expensesCount" min="1" max="10" required>
            <span class="close">&times;</span>
        </div>
        <form id="expensesForm">
            <div class="expensesField" id="expensesFieldContainer"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
var expensesModal = document.getElementById("expensesModal");
var addExpensesBtn = document.getElementById("addExpenses");
var closeBtn = document.getElementsByClassName("close")[0];

addExpensesBtn.onclick = function() {
    expensesModal.classList.add("active");
}

closeBtn.onclick = function() {
    expensesModal.classList.remove("active"); 
}

window.onclick = function(event) {
    if (event.target === expensesModal) {
        expensesModal.classList.remove("active");
    }
}

document.getElementById("expensesCount").addEventListener('input', function() {
    var count = this.value;
    var container = document.getElementById("expensesFieldContainer");

    var existingValues = {};
    for (var i = 0; i < container.children.length; i++) {
        existingValues[i] = {
            description: document.getElementById(`expenseDescription${i}`)?.value || "",
            amount: document.getElementById(`expenseAmount${i}`)?.value || "",
            category: document.getElementById(`expenseCategory${i}`)?.value || ""
        };
    }

    container.innerHTML = ""; 

    if (count < 1) {
        alert("Expenses count cannot be less than 1.");
        this.value = 1;
        count = 1;
    } else if (count > 10) {
        alert("The maximum number of expenses is 10.");
        this.value = 10;
        count = 10;
    }

    for (var i = 0; i < count; i++) {
        container.innerHTML += `
            <div class="expense-row">
                <p class="lb">${i + 1}.</p>
                <div class="form-group edescription col-5">
                    <label for="expenseDescription${i}">Description:</label>
                    <input type="text" id="expenseDescription${i}" name="expenseDescription${i}" required>
                </div>
                <div class="form-group eamount col-3">
                    <label for="expenseAmount${i}">Price:</label>
                    <input type="number" id="expenseAmount${i}" name="expenseAmount${i}" required min="0" step="0.01" placeholder="0.00">
                </div>
                <div class="form-group ecategory col-4">
                    <label for="expenseCategory${i}">Category:</label>
                    <select id="expenseCategory${i}" name="expenseCategory${i}" required onchange="showOtherInput(${i})">
                        <option value="">Select a category</option>
                        <!-- Populate categories here -->
                    </select>
                    <input type="text" id="otherCategory${i}" name="otherCategory${i}" placeholder="Other category" style="display: none; margin-top: 5px;">
                </div>
                <hr>
            </div>
        `;

        populateExpenseCategories(i, existingValues[i]);
    }
});

function populateExpenseCategories(index, existingValue) {
    fetch('../../sql/fetch/expense-categories.php') 
        .then(response => response.json())
        .then(data => {
            var categorySelect = document.getElementById(`expenseCategory${index}`);
            categorySelect.innerHTML = '<option value="">Select a category</option>'; 
            
            data.forEach(category => {
                var option = document.createElement("option");
                option.value = category.category;
                option.text = category.category;
                categorySelect.appendChild(option);
            });

            var otherOption = document.createElement("option");
            otherOption.value = "Other";
            otherOption.text = "Other";
            categorySelect.appendChild(otherOption);

            if (existingValue) {
                document.getElementById(`expenseDescription${index}`).value = existingValue.description;
                document.getElementById(`expenseAmount${index}`).value = existingValue.amount;
                categorySelect.value = existingValue.category;
                if (existingValue.category === "Other") {
                    document.getElementById(`otherCategory${index}`).style.display = "block";
                }
            }
        })
        .catch(error => {
            console.error("Error fetching categories:", error);
        });
}

function showOtherInput(index) {
    var categorySelect = document.getElementById(`expenseCategory${index}`);
    var otherInput = document.getElementById(`otherCategory${index}`);
    if (categorySelect.value === "Other") {
        otherInput.style.display = "block";
    } else {
        otherInput.style.display = "none";
    }
}

document.getElementById("expensesForm").onsubmit = function(e) {
    e.preventDefault(); 

    var expenses = [];
    var valid = true;
    var count = document.getElementById("expensesCount").value;

    for (var i = 0; i < count; i++) {
        var description = document.getElementById(`expenseDescription${i}`).value;
        var amount = document.getElementById(`expenseAmount${i}`).value;
        var category = document.getElementById(`expenseCategory${i}`).value;
        var otherCategory = document.getElementById(`otherCategory${i}`).value;

        if (!amount || isNaN(amount) || amount <= 0) {
            alert(`Please enter a valid amount for expense ${i + 1}.`);
            valid = false;
            break;
        }

        expenses.push({
            description,
            amount,
            category: category === "Other" ? otherCategory : category
        });
    }

    if (valid) {
        fetch('../../sql/insert/add-expense.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(expenses)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Expenses added successfully!");
                document.getElementById("expensesForm").reset();
                expensesModal.classList.remove("active"); 
                fetchExpensesData();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error submitting the form:", error);
            alert("An error occurred. Please try again.");
        });
    }
}
</script>
