<style>
    .form-container {
        height: 100vh;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding-bottom: 20px;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }

    .form-group.hidden {
        display: none;
    }

    .form-group button {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }
</style>
<div class="form-container py-3">
    <h2>Merchandise Order Slip</h2>
    <form class="mx-3 px-5" action="entry.php" method="post">
        <div class="form-group">
            <label for="purchaseType">Purchase Type:</label>
            <select id="purchaseType" name="purchaseType" required onchange="showFields()">
                <option value="">Select an option</option>
                <option value="uniform">Uniform</option>
                <option value="books">Books</option>
                <option value="merch">Merch</option>
            </select>
        </div>
        <div id="uniformFields" class="form-group hidden">
            <label for="uniformOrderSlipNo">Uniform Order Slip No:</label>
            <input type="text" id="uniformOrderSlipNo" name="uniformOrderSlipNo">
        </div>
        <div id="booksFields" class="form-group hidden">
            <label for="bookTitle">Book Title:</label>
            <input type="text" id="bookTitle" name="bookTitle">
            <label for="bookAuthor">Book Author:</label>
            <input type="text" id="bookAuthor" name="bookAuthor">
        </div>
        <div id="merchFields" class="form-group hidden">
            <label for="merchType">Merch Type:</label>
            <input type="text" id="merchType" name="merchType">
        </div>
        <div class="form-group">
            <label for="srCode">SR Code:</label>
            <input type="text" id="srCode" name="srCode" required>
        </div>
        <div class="form-group">
            <label for="nameOfCustomer">Name of Customer:</label>
            <input type="text" id="nameOfCustomer" name="nameOfCustomer" required>
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>
        </div>
        <div class="form-group">
            <label for="program">Program:</label>
            <input type="text" id="program" name="program" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="officialReceiptNo">Official Receipt No:</label>
            <input type="text" id="officialReceiptNo" name="officialReceiptNo" required>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<script>
    function showFields() {
        var purchaseType = document.getElementById('purchaseType').value;
        document.getElementById('uniformFields').classList.add('hidden');
        document.getElementById('booksFields').classList.add('hidden');
        document.getElementById('merchFields').classList.add('hidden');
        
        if (purchaseType === 'uniform') {
            document.getElementById('uniformFields').classList.remove('hidden');
        } else if (purchaseType === 'books') {
            document.getElementById('booksFields').classList.remove('hidden');
        } else if (purchaseType === 'merch') {
            document.getElementById('merchFields').classList.remove('hidden');
        }
    }
</script>
