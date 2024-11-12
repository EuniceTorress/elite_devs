  <div id="rentals" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Event Details</h5>
        <span id="closeModalBtn" class="close-icon">&times;</span>
      </div>

      <div class="modal-body">
        <div class="d-flex">
          <div class="form-group col-2">
            <label for="guestCount">Guest No.</label>
            <input type="number" id="guestCount" class="col-10">
          </div>

          <div class="form-group col-3">
            <label for="eventDate">Date:</label>
            <input type="date" id="eventDate" class="col-11">
          </div>

          <div class="form-group col-2">
            <label for="eventTime">Time:</label>
            <input type="time" id="eventTime" class="col-11">
          </div>

          <div class="form-group col-5 purpose">
            <label for="eventPurpose">Purpose:</label>
            <div class="d-flex">
              <select id="eventPurpose" onchange="handlePurposeChange()">
                <option value="">Select Purpose</option>
                <option value="Meeting">Meeting</option>
                <option value="Conference">Conference</option>
                <option value="Other">Other</option>
              </select>
              <input type="text" id="otherPurposeField" class="hidden" placeholder="Please specify">
            </div>
          </div>
        </div>
        <div class="d-flex mt-3">
          <div class="form-group col-6">
            <label for="facility">Facility:</label>
            <select id="facility" name="facility">
              <option value="">Select Facility</option>
          </select>
          </div>

          <div class="form-group col-2">
            <label for="facilityHours">No. of Hours:</label>
            <input type="number" id="facilityHours" class="col-10">
          </div>

          <div class="form-group col-2">
            <label>Cost:</label>
            <span id="facilityCost">$100000</span>
          </div>

          <div class="form-group col-2 ml-10">
            <label>Total Cost:</label>
            <span id="facilityTotalCost">$200</span>
          </div>
        </div>

        <div class="d-flex">
          <h5>Manpower</h5>
          <button id="addManpowerBtn" class="add-more-btn"><span class="material-icons">add</span></button>
        </div>
        <div id="manpowerContainer"></div>

        <div class="form-group col-12">
          <label for="otherRequirements">Other Requirements:</label>
          <textarea id="otherRequirements" rows="3" placeholder="Enter other requirements" class="col-12"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button class="submit-btn">Submit<span class="material-icons">send</span></button>
      </div>
    </div>
  </div>

<?php
include '../../src/js/modal/rent-facility/price.php';
include '../../src/js/modal/rent-facility/submit.php';
?>

  <script>
document.getElementById('openReserveFacility').addEventListener('click', function() {
  const modal = document.getElementById('rentals');
  modal.classList.add('show');
});

document.getElementById('closeModalBtn').addEventListener('click', function() {
  const modal = document.getElementById('rentals');
  modal.classList.remove('show');
});

    function handlePurposeChange() {
      const purpose = document.getElementById('eventPurpose').value;
      const otherPurposeField = document.getElementById('otherPurposeField');
      
      if (purpose === 'Other') {
        otherPurposeField.classList.remove('hidden');
      } else {
        otherPurposeField.classList.add('hidden');
      }
    }

    let manpowerCount = 0;

    document.getElementById('addManpowerBtn').addEventListener('click', function() {
      const manpowerContainer = document.getElementById('manpowerContainer');

      const manpowerRow = document.createElement('div');
      manpowerRow.className = 'manpower-row';
      manpowerRow.id = `manpowerRow${manpowerCount}`;

      manpowerRow.innerHTML = `
      <div class="d-flex manpowerCont">
        <div class="form-group col-5">
          <label for="manpower">Manpower:</label>
          <select id="manpower" name="manpower">
              <option value="">Select Manpower</option>
          </select>
        </div>
        <div class="form-group col-2">
          <label for="manpowerHours${manpowerCount}">No. of Hours:</label>
          <input type="number" id="manpowerHours${manpowerCount}" class="col-10">
        </div>
        <div class="form-group">
          <label>Cost:</label>
          <span id="manpowerCost">$50</span>
        </div>
        <div class="form-group ml-10">
          <label>Total Cost:</label>
          <span id="manpowerTotalCost">$100</span>
        </div>
        <span class="material-icons" onclick="removeManpowerRow(${manpowerCount})" id="delManpowerBtn">remove</span>
      </div>
      `;

      manpowerContainer.appendChild(manpowerRow);
      manpowerCount++;
    });

    function removeManpowerRow(index) {
      const row = document.getElementById(`manpowerRow${index}`);
      row.parentNode.removeChild(row);
    }
    function populateFacilities() {
    fetch('fetch_options.php?type=facility')
        .then(response => response.json())
        .then(data => {
            const facilitySelect = document.getElementById('facility');
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.facility_name;
                facilitySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}

function populateManpower() {
    fetch('fetch_options.php?type=manpower')
        .then(response => response.json())
        .then(data => {
            const manpowerSelect = document.getElementById('manpower');
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.manpower_name;
                manpowerSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    populateFacilities();
    populateManpower();
});
  </script>