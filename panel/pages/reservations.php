<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Reservation List</h2>

    <label for="statusFilter">Filter by Status:</label>
    <select id="statusFilter" onchange="filterTable()">
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="reviewed">Reviewed</option>
        <option value="accepted">Accepted</option>
        <option value="rejected">Rejected</option>
    </select>

    <label for="monthFilter">Filter by Month:</label>
    <select id="monthFilter" onchange="filterTable()">
        <option value="all">All</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>

    <table id="reservationTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Items Reserved</th>
                <th>Date Reserved</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>Item 1, Item 2</td>
                <td>2024-01-15</td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>Item 3</td>
                <td>2024-02-20</td>
                <td>Reviewed</td>
            </tr>
            <tr>
                <td>Mike Johnson</td>
                <td>Item 4, Item 5</td>
                <td>2024-03-10</td>
                <td>Accepted</td>
            </tr>
            <tr>
                <td>Emily Davis</td>
                <td>Item 6</td>
                <td>2024-04-22</td>
                <td>Rejected</td>
            </tr>
        </tbody>
    </table>

    <script>
        function filterTable() {
            var statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            var monthFilter = document.getElementById('monthFilter').value;
            var table = document.getElementById('reservationTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                var tdStatus = tr[i].getElementsByTagName('td')[3];
                var tdDate = tr[i].getElementsByTagName('td')[2];
                
                if (tdStatus && tdDate) {
                    var status = tdStatus.textContent.toLowerCase();
                    var date = new Date(tdDate.textContent);
                    var month = ('0' + (date.getMonth() + 1)).slice(-2);

                    var statusMatch = (statusFilter === 'all' || status === statusFilter);
                    var monthMatch = (monthFilter === 'all' || month === monthFilter);

                    if (statusMatch && monthMatch) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>

</body>
</html>
