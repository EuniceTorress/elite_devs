<?php
  include '../../modal/stocks/view-cart.php';
?>
<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-2">ID</th>
        <th class="col-4">Item(s)</th>
        <th class="col-1">Quantity</th>
        <th class="col-1">Price</th>
        <th class="col-2">Status</th>
        <th class="col-2">Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <div id="no-data">No record of reservation. <a href="body.php?stocks-1" id="vm-link">Visit merchandise now !</a></div>
        <td colspan="6" class="text-center"><div id="spinner" class="spinner"></div></td>
      </tr>
    </tbody>
  </table>
</div>

<script>
  const spinner = document.getElementById('spinner');
  const noDataDiv = document.getElementById('no-data');

  spinner.style.display = "block";

  fetch('../../sql/fetch/stock-c-reservation.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const tbody = document.querySelector('#all-table tbody');
      tbody.innerHTML = ''; 
      spinner.style.display = "none"; 
      
      if (data.length === 0) {
        noDataDiv.style.display = "block"; 
        return;
      }

      noDataDiv.style.display = "none"; 

      data.forEach(row => {
        const itemNames = row.details.map(detail => `${detail.item_name} (${detail.description})`).join(' || ');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.id}</td>
            <td>${itemNames}</td>
            <td>${row.total_quantity}</td>
            <td>${row.total_price}</td>
            <td>${row.status === "0" ? "Pending" : "Completed"}</td>
            <td>${row.requested}</td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(error => {
      spinner.style.display = "none"; 
      noDataDiv.style.display = "block"; 
      console.error('Error fetching data:', error);
    });
</script>
