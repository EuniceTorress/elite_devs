<div id="editPricingModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h5>Graduation Picture Price</h5>
      <button type="button" class="close" onclick="toggleModal()">×</button>
    </div>

    <form id="pricingForm">
      <div class="modal-body">
        <div class="form-group d-flex justify-content-around">
          <label><input type="radio" name="editOption" value="setPrice" checked onclick="toggleFields()"> Set Price</label>
          <label><input type="radio" name="editOption" value="price" onclick="toggleFields()"> Edit Price</label>
          <label><input type="radio" name="editOption" value="cost" onclick="toggleFields()"> Edit Cost</label>
        </div>

        <div class="form-row">
          <div class="form-group" id="price-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" min="0" step="0.01">
          </div>

          <div class="form-group" id="cost-group">
            <label for="cost">Cost</label>
            <input type="number" id="cost" name="cost" min="0" step="0.01">
          </div>

          <div class="form-group" id="date-group">
            <label for="date">Date</label>
            <select id="date" name="date" required>
              <option value="">Select Date</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const editPricingTrigger = document.getElementById("edit-pricing");
    if (editPricingTrigger) {
      editPricingTrigger.addEventListener("click", openPricingModal);
    }

    document.getElementById("pricingForm").addEventListener("submit", function(event) {
      event.preventDefault();
      handleFormSubmission();
    });
  });

  function toggleModal() {
    document.getElementById('editPricingModal').classList.toggle('show');
  }

  function openPricingModal() {
    toggleModal();
    resetForm();
    updateDateOptions("setPrice");
  }

  function updateDateOptions(option) {
    const dateSelect = document.getElementById("date");
    dateSelect.innerHTML = '<option value="">Select Date</option>';

    const url = option === "price" 
      ? '../../sql/fetch/stock-m-price.php' 
      : option === "cost" 
      ? '../../sql/fetch/stock-m-cost.php' 
      : '../../sql/fetch/stock-m-all.php';

    fetch(url)
      .then(response => response.json())
      .then(dates => {
        dates.forEach(date => {
          const optionElement = document.createElement("option");
          optionElement.value = date;
          optionElement.textContent = date;
          dateSelect.appendChild(optionElement);
        });
      })
      .catch(error => console.error("Error fetching dates:", error));
  }

  function resetForm() {
    document.getElementById("pricingForm").reset();
    toggleFieldVisibility("setPrice");
    updateDateOptions("setPrice");
  }

  function toggleFields() {
    const selectedOption = document.querySelector('input[name="editOption"]:checked').value;
    toggleFieldVisibility(selectedOption);
    updateDateOptions(selectedOption);
  }

  function toggleFieldVisibility(option) {
    const priceGroup = document.getElementById("price-group");
    const costGroup = document.getElementById("cost-group");

    if (option === "setPrice") {
      priceGroup.style.display = "block";
      costGroup.style.display = "block";
      setFieldColClasses("col-4");
    } else if (option === "price") {
      priceGroup.style.display = "block";
      costGroup.style.display = "none";
      setFieldColClasses("col-6");
    } else if (option === "cost") {
      priceGroup.style.display = "none";
      costGroup.style.display = "block";
      setFieldColClasses("col-6");
    }
  }

  function setFieldColClasses(colClass) {
    document.getElementById("price-group").className = `form-group ${colClass}`;
    document.getElementById("cost-group").className = `form-group ${colClass}`;
    document.getElementById("date-group").className = `form-group ${colClass}`;
  }

  function handleFormSubmission() {
    const selectedOption = document.querySelector('input[name="editOption"]:checked').value;
    const price = selectedOption !== "cost" ? document.getElementById("price").value : null;
    const cost = selectedOption !== "price" ? document.getElementById("cost").value : null;
    const date = document.getElementById("date").value;
    const formattedDate = new Date(date).toISOString().split('T')[0];

    const body = selectedOption === "price" 
      ? `price=${price}&date=${formattedDate}` 
      : selectedOption === "cost" 
      ? `cost=${cost}&date=${formattedDate}` 
      : `price=${price}&cost=${cost}&date=${formattedDate}`;

    fetch('../../sql/insert/add-pricing.php', {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: body,
    })
      .then(response => response.json())
      .then(data => {
        alert(data.success ? "Data saved successfully: " + data.message : "Error saving data: " + data.error);
        fetchMemorabilia();
        resetForm();
        toggleModal();
      })
      .catch(error => console.error("Error submitting data:", error));


  }
</script>
