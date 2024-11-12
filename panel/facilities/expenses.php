<style>
    .icon-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
        margin: 0 5px;
        outline: none;
        transition: transform 0.2s ease-in-out, color 0.3s ease;
        font-size: 1.5rem;
    }

    .icon-btn span {
        color: #1c1e21;
    }

    .icon-btn:hover span {
        color: maroon;
        transform: scale(1.1);
    }

    .icon-btn:focus span {
        color: maroon;
        box-shadow: 0 0 0 0.1rem rgba(128, 0, 0, 0.2);
    }
</style>

<?php
include '../../modal/facilities/add-expenses.php'; 
?>

<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-3">ID</th>
        <th class="col-5">Expenses</th>
        <th class="col-2">Price</th>
        <th class="col-2">Rate</th>
      </tr>
    </thead>
    <tbody id="expenses-data"></tbody> 
  </table>
</div>

<script>
    let isExpensesDataLoaded = false; 

    function fetchExpensesData() { 
        fetch('../../sql/fetch/expenses.php') 
            .then(res => {
                if (!res.ok) throw new Error('Network response not ok');
                return res.json();
            })
            .then(data => {
                if (!isExpensesDataLoaded) {
                    isExpensesDataLoaded = true;
                }
                populateExpensesTable(data); 
            })
            .catch(err => console.error('Error fetching expenses data:', err));
    }

    function populateExpensesTable(data) { 
        let rows = data.length > 0 ? data.map(expense => 
            `<tr data-id="${expense.id}" data-expenses="${expense.expenses}" data-price="${expense.price}" data-status="${expense.available}">
                <td>${expense.id}</td>
                <td>${expense.expenses}</td> <!-- Changed reference -->
                <td>${expense.price}</td>
                <td>${expense.available}</td>
                <td class="text-center">
                    <button class="icon-btn edit-btn" data-id="${expense.id}">
                        <span class="material-icons">edit</span>
                    </button>
                    <button class="icon-btn delete-btn" data-id="${expense.id}">
                        <span class="material-icons">delete</span>
                    </button>
                </td>
            </tr>`).join('') : '<tr><td colspan="5">No expenses available</td></tr>'; 

        document.getElementById('expenses-data').innerHTML = rows; 

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                let expenseId = this.dataset.id; 
                let row = this.closest('tr');
                let expenseName = row.dataset.expenses; 
                let expensePrice = row.dataset.price;
                let expenseStatus = row.dataset.status;

                document.getElementById('expense-id').value = expenseId; 
                document.getElementById('expense-name').value = expenseName; 
                document.getElementById('expense-price').value = expensePrice;
                document.getElementById('expense-status').value = expenseStatus; 

                $('#editExpenseModal').modal('show'); 
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let expenseId = this.dataset.id; 
                if (confirm('Are you sure you want to delete this expense record?')) {
                    deleteExpense(expenseId);
                }
            });
        });
    }

    function deleteExpense(expenseId) { 
        fetch(`../../sql/delete/expenses.php?id=${expenseId}`, { 
            method: 'DELETE'
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response not ok');
            return res.json();
        })
        .then(data => {
            if (data.success) {
                alert('Expense record deleted successfully');
                fetchExpensesData();
            } else {
                alert('Error deleting expense record');
            }
        })
        .catch(err => console.error('Error deleting expense:', err));
    }

    fetchExpensesData(); 
    setInterval(fetchExpensesData, 10000); 
</script>
