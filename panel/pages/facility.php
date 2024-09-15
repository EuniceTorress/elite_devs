<style>
    #facilitiesInfo {
        height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        margin: 0 auto;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        display: flex;
        align-items: flex-start;
        padding: 20px;
        box-sizing: border-box;
    }

    .facilties-container,
    .manpower-container {
        flex: 1;
        overflow: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px 15px;
        text-align: left;
        font-size: 0.8rem;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    th {
        color: maroon;
        position: relative;
        cursor: pointer;
        font-size: 0.8rem;
        user-select: none;
        border-top: 1px solid maroon;
        border-bottom: 1px solid maroon;
        transition: background-color 0.2s ease;
    }

    th:hover {
        background-color: #f5f5f5;
        box-shadow: inset 0 10px 10px rgba(0, 0, 0, 0.1);
    }

    tbody tr:hover {
        background-color: #f9f9f9;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2);
    }

    th::after {
        content: '\25BC';
        font-size: 0.8rem;
        position: absolute;
        right: 30px;
        color: maroon;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    th.show::after {
        transform: rotate(180deg);
    }

    td {
        border-bottom: 1px solid #e0e0e0;
        transition: background-color 0.2s ease;
    }

    tr:last-child td {
        border-bottom: none;
    }

    .action-column {
        text-align: center;
    }

    .action-column button {
        margin-right: 5px;
    }

    .divider {
        width: 1px;
        background-color: maroon;
        height: 100%;
        margin: 0 20px;
    }
</style>
<div class="container-fluid" id="facilitiesInfo">
    <div class="facilties-container">
        <h3>Facilities</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Facility Name</th>
                    <th>Location</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $facilities = [
                    ['id' => 'FAC-001', 'name' => 'Main Hall', 'location' => 'Building A', 'type' => 'Conference Room'],
                    ['id' => 'FAC-002', 'name' => 'Gymnasium', 'location' => 'Building B', 'type' => 'Sports Facility'],
                ];

                foreach ($facilities as $facility) {
                    echo "<tr>
                            <td>{$facility['id']}</td>
                            <td>{$facility['name']}</td>
                            <td>{$facility['location']}</td>
                            <td>{$facility['type']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="divider"></div>

    <div class="manpower-container">
        <h3>Manpower</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Manpower</th>
                    <th>Price per Hour</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $manpower = [
                    ['id' => 'MP-001', 'manpower' => 'John Doe', 'price' => '$25', 'available' => '10'],
                    ['id' => 'MP-002', 'manpower' => 'Jane Smith', 'price' => '$30', 'available' => '5'],
                ];

                foreach ($manpower as $person) {
                    echo "<tr>
                            <td>{$person['id']}</td>
                            <td>{$person['manpower']}</td>
                            <td>{$person['price']}</td>
                            <td>{$person['available']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

