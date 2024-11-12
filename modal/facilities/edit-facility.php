<div class="modal fade" id="editFacilityModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 class="modal-title" id="display-name"></h2>
                <form id="editFacilityForm">
                    <div class="f-details">
                        <p class="id-text">ID:</p>
                        <span id="display-id"></span>
                    </div>
                    <input type="text" class="input-d" id="facility-id" hidden>
                    <div class="form-row">
                        <div class="form-group f-price">
                            <label for="facility-price">Price</label>
                            <div class="f-details">
                                <span id="display-price"></span>
                                <input type="number" class="input-d" id="facility-price" required>
                            </div>
                        </div>
                        <div class="form-group f-rate">
                            <label for="facility-rate">Rate</label>
                            <div class="f-details">
                                <span id="display-rate"></span>
                                <div class="input-d" id="rate-selector"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group f-switch">
                        <label class="switch">
                            <input type="checkbox" class="input-d" id="facility-availability" onchange="updateAvailabilityText()">
                            <span class="slider"></span>
                        </label>
                        <span id="availability-indicator" class="availability-label"></span>
                    </div>

                    <span class="material-icons edit-icon" onclick="toggleEditMode()">edit_note</span>
                    <span class="material-icons save-icon" onclick="saveDetails()">save</span>
                    <span class="material-icons cancel-icon" onclick="cancelEdit()">cancel</span>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(fd) {
        populateModal(fd); 
        $('#editFacilityModal').modal('show'); 
    }

    function closeModal() {
        $('#editFacilityModal').modal('hide');
    }

    function populateModal(fd) {
        document.getElementById('facility-id').value = fd.id;
        document.getElementById('display-id').textContent = fd.id;
        document.getElementById('display-name').textContent = fd.name;
        document.getElementById('facility-price').value = fd.price;
        document.getElementById('display-price').textContent = `₱ ${parseFloat(fd.price).toFixed(2)}`;
        document.getElementById('display-rate').textContent = fd.rate;
        
        if (fd.availability === "2") {
            document.getElementById('facility-availability').checked = false;
            document.getElementById('availability-indicator').textContent = "Under Maintenance";
            document.getElementById('availability-indicator').style.color = 'red'; 
            document.getElementById('availability-indicator').style.opacity = '0.7'; 
        } else {
            document.getElementById('facility-availability').checked = true;
            document.getElementById('availability-indicator').textContent = "Available";
            document.getElementById('availability-indicator').style.color = '';
            document.getElementById('availability-indicator').style.opacity = '';
        }
    }

    function saveDetails() {
        const updatedPrice = document.getElementById('facility-price').value;
        const updatedAvailability = document.getElementById('facility-availability').checked ? "0" : "2";

        document.getElementById('display-price').textContent = `₱ ${parseFloat(updatedPrice).toFixed(2)}`;
        document.getElementById('availability-indicator').textContent = updatedAvailability === "2" ? "Under Maintenance" : "Available";

        if (updatedAvailability === "2") {
            document.getElementById('availability-indicator').style.color = 'red'; 
            document.getElementById('availability-indicator').style.opacity = '0.7'; 
        } else {
            document.getElementById('availability-indicator').style.color = ''; 
            document.getElementById('availability-indicator').style.opacity = ''; 
        }

        toggleDisplayMode();  
        $('#editFacilityModal').modal('hide');  
    }

    function cancelEdit() {
        toggleDisplayMode();
    }

    function toggleEditMode() {
        document.querySelectorAll('.f-details span').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.input-d').forEach(el => el.style.display = 'block');
        document.querySelector('.edit-icon').style.display = 'none';
        document.querySelector('.save-icon').style.display = 'inline';
        document.querySelector('.cancel-icon').style.display = 'inline';
    }

    function toggleDisplayMode() {
        document.querySelectorAll('.f-details span').forEach(el => el.style.display = 'inline');
        document.querySelectorAll('.input-d').forEach(el => el.style.display = 'none');
        document.querySelector('.edit-icon').style.display = 'inline';
        document.querySelector('.save-icon').style.display = 'none';
        document.querySelector('.cancel-icon').style.display = 'none';
    }

    function updateAvailabilityText() {
        const isChecked = document.getElementById('facility-availability').checked;
        document.getElementById('availability-indicator').textContent = isChecked ? "Available" : "Under Maintenance";
        if (isChecked) {
            document.getElementById('availability-indicator').style.color = ''; 
            document.getElementById('availability-indicator').style.opacity = ''; 
        } else {
            document.getElementById('availability-indicator').style.color = 'red'; 
            document.getElementById('availability-indicator').style.opacity = '0.7'; 
        }
    }

    document.querySelectorAll('.edit-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const row = this.closest('tr');

            const fd = {
                id: row.dataset.id,
                name: row.dataset.facility,
                price: row.dataset.price,
                availability: row.dataset.status, 
                availability: row.dataset.rate 
            };

            openEditModal(fd); 
        });
    });
</script>
