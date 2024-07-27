<style>
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Adjust height as needed */
    padding: 20px;
  }

  .input-group-addon {
    padding: 6px 12px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-top-right-radius: 20px; /* Rounded corners for addon */
    border-bottom-right-radius: 20px; /* Rounded corners for addon */
    width: 50px;
  }

  .form-control {
    border-top-left-radius: 20px; /* Rounded corners for input */
    border-bottom-left-radius: 20px; /* Rounded corners for input */
  }

  .input-group {
    margin-bottom: 20px; /* Spacing between input and table */
  }

  .table-container {
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow */
    padding: 20px; /* Padding inside the box */
    width: 100%; /* Full width */
    max-width: 800px; /* Optional: Set a maximum width to limit growth */
  }

  .table {
    width: 100%; /* Ensure table takes full width */
  }

  .action-column {
    text-align: center; /* Center align action buttons */
  }

  .action-column button {
    margin-right: 5px; /* Add spacing between buttons */
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="search" placeholder="Quick search">
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-search"></span>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="table-container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Stock Number</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th class="text-center">Action</th> <!-- Updated column title aligned with values -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>John</td>
          <td>Doe</td>
          <td class="action-column">
            <button type="button" class="btn btn-primary btn-xs" title="Edit">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button type="button" class="btn btn-danger btn-xs" title="Delete">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Mary</td>
          <td>Moe</td>
          <td class="action-column">
            <button type="button" class="btn btn-primary btn-xs" title="Edit">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button type="button" class="btn btn-danger btn-xs" title="Delete">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>July</td>
          <td>Dooley</td>
          <td class="action-column">
            <button type="button" class="btn btn-primary btn-xs" title="Edit">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button type="button" class="btn btn-danger btn-xs" title="Delete">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>