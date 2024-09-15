<style>
    #facilityInfo {
        height: 90vh;
        overflow-y: auto;
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

    .facility-container {
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
</style>

<div class="container-fluid" id="facilityInfo">
    <div class="facility-container">
        <table>
            <thead>
                <tr>
                    <th>Facility ID</th>
                    <th>Facility Name</th>
                    <th>Location</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $facilities = [
                    ['facility_id' => 'F-001', 'facility_name' => 'Tennis Court', 'location' => 'Downtown', 'type' => 'Sport'],
                    ['facility_id' => 'F-002', 'facility_name' => 'Community Hall', 'location' => 'East Side', 'type' => 'Event'],
                    ['facility_id' => 'F-003', 'facility_name' => 'Swimming Pool', 'location' => 'West Park', 'type' => 'Recreation'],
                ];

                foreach ($facilities as $facility) {
                    echo "<tr>
                            <td>{$facility['facility_id']}</td>
                            <td>{$facility['facility_name']}</td>
                            <td>{$facility['location']}</td>
                            <td>{$facility['type']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
