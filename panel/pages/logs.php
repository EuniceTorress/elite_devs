<style>
    #activityLog {
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

    .activity-container {
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
</style>

<div class="container-fluid" id="activityLog">
    <div class="activity-container">
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $activity_log = [
                    ['type' => 'Login', 'description' => 'User logged in successfully', 'date' => '2023-09-01'],
                    ['type' => 'Update', 'description' => 'Profile information updated', 'date' => '2023-09-03'],
                    ['type' => 'Error', 'description' => 'Failed login attempt', 'date' => '2023-09-05'],
                    ['type' => 'Logout', 'description' => 'User logged out', 'date' => '2023-09-06'],
                ];

                foreach ($activity_log as $log) {
                    echo "<tr>
                            <td>{$log['type']}</td>
                            <td>{$log['description']}</td>
                            <td>{$log['date']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
