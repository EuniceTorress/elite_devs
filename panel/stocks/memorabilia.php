<?php include '../../modal/stocks/add-memorabilia.php'; ?>
<?php include '../../modal/stocks/edit-pricing.php'; ?>

<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-1">ID</th>
        <th class="col-3">Name</th>
        <th class="col-3">Program</th>
        <th class="col-1">Cost</th>
        <th class="col-1">Price</th>
        <th class="col-2">Date Arrived</th>
        <th class="col-1">Claimed</th>
      </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
  </table>
</div>

<script>
  function fetchMemorabilia() {
    fetch('../../sql/fetch/stock-memorabilia.php') 
      .then(response => response.json())
      .then(data => {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = ''; 

        data.forEach(item => {
          const row = `<tr>
                         <td>${item.id}</td>
                         <td>${item.name}</td>
                         <td>${item.program}</td>
                         <td>${item.cost}</td>
                         <td>${item.price}</td>
                         <td>${item.date}</td>
                         <td>${item.status}</td>
                       </tr>`;
          tableBody.innerHTML += row;
        });
      })
      .catch(error => console.error('Error fetching data:', error));
  }

  window.onload = fetchMemorabilia;
</script>
