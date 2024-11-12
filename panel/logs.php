<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-2">User</th>
        <th class="col-5">Description</th>
        <th class="col-2">Table</th>
        <th class="col-1">Action</th>
        <th class="col-2">Date</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('../../sql/fetch/logs.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#all-table tbody");
            tableBody.innerHTML = ""; 

            data.forEach(row => {
                const tr = document.createElement("tr");
                
                tr.innerHTML = `
                    <td>${row.name}</td>
                    <td>${row.description}</td>
                    <td>${row.table_name}</td>
                    <td>${row.action}</td>
                    <td>${row.date}</td>
                `;
                tableBody.appendChild(tr);
            });
        })
        .catch(error => console.error("Error fetching data:", error));
});
</script>
