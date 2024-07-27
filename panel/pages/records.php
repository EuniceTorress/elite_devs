<style>
  .sales-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh; /* Ensure full viewport height */
        padding: 20px;
        background-color: #f0f0f0; /* Light gray background */
    }

    .sales-box {
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow */
        padding: 20px; /* Padding inside the box */
        width: 80%; /* Adjust width as needed */
        max-width: 900px; /* Optional: Set a maximum width to limit growth */
        margin-bottom: 20px; /* Space below the box */
    }

    /* Table styles */
    .table {
        width: 100%;
        margin-bottom: 0; /* Remove default margin */
    }

    .table th,
    .table td {
        text-align: left; /* Adjust text alignment */
    }

    .action-column {
        text-align: center; /* Center align action buttons */
    }

    .action-column button {
        margin-right: 5px; /* Add spacing between buttons */
    }

</style>

<div class="sales-container">
    <div class="sales-box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>OR-Number</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy sales data (10 rows) -->
                <tr>
                    <td>OR-001</td>
                    <td>Product A</td>
                    <td>5</td>
                    <td>2024-07-18</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-002</td>
                    <td>Product B</td>
                    <td>3</td>
                    <td>2024-07-17</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-003</td>
                    <td>Product C</td>
                    <td>2</td>
                    <td>2024-07-16</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-004</td>
                    <td>Product D</td>
                    <td>1</td>
                    <td>2024-07-15</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-005</td>
                    <td>Product E</td>
                    <td>4</td>
                    <td>2024-07-14</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-006</td>
                    <td>Product F</td>
                    <td>2</td>
                    <td>2024-07-13</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-007</td>
                    <td>Product G</td>
                    <td>3</td>
                    <td>2024-07-12</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-008</td>
                    <td>Product H</td>
                    <td>1</td>
                    <td>2024-07-11</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-009</td>
                    <td>Product I</td>
                    <td>5</td>
                    <td>2024-07-10</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OR-010</td>
                    <td>Product J</td>
                    <td>2</td>
                    <td>2024-07-09</td>
                    <td class="action-column">
                        <button type="button" class="btn btn-primary btn-xs" title="View">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>