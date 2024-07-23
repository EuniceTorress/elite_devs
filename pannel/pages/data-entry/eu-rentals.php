<style>
    .form-group label {
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group .form-control {
        border-radius: 10px;
        text-align: justify;
    }
    
    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding-bottom: 20px;
    }

    input {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    input[type="text"],
    input[type="tel"],
    input[type="date"],
    textarea,
    select {
        padding: 10px;
        border-radius: 10px;
        transition: border-color 0.3s ease; 
        font-size: 14px;
    }

    .form-control {
        padding: 0.5rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-size: 15px;
    }

    input[type="text"]:focus,
    input[type="tel"]:focus,
    input[type="date"]:focus,
    textarea:focus,
    select:focus,
    .form-control:focus {
        border-color: maroon;
        outline: none;
        box-shadow: 0 0 0 0.1rem rgba(128,0,0,0.2);
    }
    

    .checkbox-group label {
        margin-right: 20px;
    }

    .table thead th {
        background-color: #f8f9fa;
    }

    .summary {
        margin-top: 20px;
        font-weight: bold;
    }

    .summary-field {
        margin-top: 10px;
    }

    #applicationNo {
        top: -5px;
    }

    .form-container .lb {
        padding: 10px;
        font-size: 20px;
    }

    input::placeholder,
    textarea::placeholder,
    select::placeholder {
        font-size: 12px;
        padding: 2px;
    }

    .form-container .eg {
        margin-top: 8px;
        margin-left: -25px;
    }

    .btn {
        margin-top: 10px;
    }

    .btn-primary {
        background-color: maroon;
        border-color: maroon;
        border-radius: 10px;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        border-radius: 10px;
    }

    .btn-primary:hover,
    .btn-danger:hover {
        opacity: 0.8;
    }

    hr {
        border: 1px solid rgba(0,0,0,0.1);
        margin-top: 20px;
    }
</style>

<div class="form-container py-3">
    <h2>Application Form for Renting University Facility</h2>
    <form class="mx-3 px-5">
        <!-- Personal Information -->
        <div class="row mt-5">
            <p class="lb col-2">Name of Renter:</p>
            <div class="form-group col-2">
                <label for="firstName" class="ml-3">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group col-2">
                <label for="middleName" class="ml-3">Middle Name:</label>
                <input type="text" class="form-control" id="middleName" name="middleName" required>
            </div>
            <div class="form-group col-2">
                <label for="lastName" class="ml-3">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group col-1">
                <label for="suffix" class="ml-2">Suffix:</label>
                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Optional">
            </div>
            <div class="form-group col-2 ml-auto">
                <label for="contactNumber" class="ml-3">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
            </div>
        </div>
        <div class="row">
            <p class="lb col-2">Address:</p>
            <div class="form-group col-2">
                <label for="province" class="ml-3">Province</label>
                <select class="form-control" id="province" name="province" required>
                    <option value="">Select Province</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="municipality" class="ml-3">Municipality</label>
                <select class="form-control" id="municipality" name="municipality" required>
                    <option value="">Select Municipality</option>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="barangay" class="ml-3">Barangay</label>
                <select class="form-control" id="barangay" name="barangay" required>
                    <option value="">Select Barangay</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="street" class="ml-2">Street</label>
                <select class="form-control" id="street" name="street">
                    <option value="">Select Street</option>
                </select>
            </div>
        </div>
        <div class="row">
            <p class="lb col-3">Expected Number of Guests:</p>
            <div class="form-group col-1">
                <input type="number" class="form-control eg" id="expectedNumberOfGuests" name="expectedNumberOfGuests" required>
            </div>
            <div class="form-group col-2">
                <label for="dateOfEvent" class="ml-2">Date:</label>
                <input type="date" class="form-control" id="dateOfEvent" name="dateOfEvent" required>
            </div>
            <div class="form-group col-2">
                <label for="timeOfEvent" class="ml-2">Time:</label>
                <input type="time" class="form-control" id="timeOfEvent" name="timeOfEvent" required>
            </div>
            <div class="form-group col-4">
                <label for="purpose" class="ml-3">Purpose:</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>
        </div>
        <!-- Facility Selection -->
        <h4>I. FACILITY/IES to be rented (Please select one or more):</h4>
        <div class="row">
            <div class="form-group col-4">
                <label for="facilities" class="ml-2">Facilities</label>
                <div class="checkbox-group" id="facilities">
                    <label><input type="checkbox" name="facility[]" value="Amphitheater"> Amphitheater</label>
                    <label><input type="checkbox" name="facility[]" value="Multimedia Room"> Multimedia Room</label>
                    <label><input type="checkbox" name="facility[]" value="Classroom"> Classroom</label>
                    <label><input type="checkbox" name="facility[]" value="Covered Court"> Covered Court</label>
                    <label><input type="checkbox" name="facility[]" value="Gymnasium with aircon"> Gymnasium with aircon</label>
                    <label><input type="checkbox" name="facility[]" value="Gymnasium without aircon"> Gymnasium without aircon</label>
                    <label><input type="checkbox" name="facility[]" value="Other facility/ies"> Other facility/ies</label>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="numberOfHours" class="ml-2">No. of Hours<span style="font-size: 10px"><br>(minimum of 4 hours)</span></label>
                <input type="number" class="form-control" id="numberOfHours" name="numberOfHours" required>
            </div>
            <div class="form-group col-2">
                <p>Amount: <span id="amountDisplay">0.00</span></p>
            </div>
        </div>
        <div id="otherFacilityDetails" class="form-group col-12 mt-2" style="display: none;">
            <label for="otherFacilitySpec" class="ml-3">Please specify:</label>
            <input type="text" class="form-control" id="otherFacilitySpec" name="otherFacilitySpec">
        </div>
        <!-- Manpower Requirements -->
        <div id="manpower-container">
            <h4 class="mt-3">Manpower Requirements:</h4>
            <div class="manpower-entry">
                <div class="row">
                    <div class="form-group col-2">
                        <label for="particulars" class="ml-3">Particulars:</label>
                        <select class="form-control" name="particulars[]" required>
                            <option value="">Select Particulars</option>
                            <option value="Technician">Technician</option>
                            <option value="Janitor">Janitor</option>
                            <option value="Security Guard">Security Guard</option>
                            <option value="Carpenter">Carpenter</option>
                            <option value="Electrician">Electrician</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label for="number" class="ml-3">Number:</label>
                        <input type="number" class="form-control" name="number[]" required>
                    </div>
                    <div class="form-group col-2">
                        <label for="time" class="ml-3">Time:</label>
                        <input type="time" class="form-control" name="time[]" required>
                    </div>
                    <div class="form-group col-2">
                        <label for="hours" class="ml-3">No. of Hours:</label>
                        <input type="number" class="form-control" name="hours[]" required>
                    </div>
                    <div class="form-group col-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-entry">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addManpower">Add Manpower</button>
            </div>
        </div>
        <!-- Amenities -->
        <div class="row">
            <div class="form-group col-4">
                <label for="amenities" class="ml-3">Amenities:</label>
                <div class="checkbox-group" id="amenities">
                    <label><input type="checkbox" name="amenities[]" value="Sound System"> Sound System</label>
                    <label><input type="checkbox" name="amenities[]" value="Projector"> Projector</label>
                    <label><input type="checkbox" name="amenities[]" value="Lighting"> Lighting</label>
                    <label><input type="checkbox" name="amenities[]" value="Seating"> Seating</label>
                    <label><input type="checkbox" name="amenities[]" value="Catering"> Catering</label>
                </div>
            </div>
        </div>
        <!-- Terms and Conditions -->
        <h4>II. TERMS AND CONDITIONS</h4>
        <p class="mt-2">1. A down payment of 50% is required upon reservation.</p>
        <p>2. Full payment must be made at least one week before the event date.</p>
        <p>3. Cancellation policy: 25% of the total amount will be deducted for cancellations made within 48 hours of the event.</p>
        <p>4. Any damages to the property will be charged to the renter.</p>
        <p>5. The University reserves the right to deny rental applications if deemed necessary.</p>
        <!-- Declaration and Signature -->
        <h4>III. DECLARATION</h4>
        <p class="mt-2">I hereby declare that the information provided above is true and correct. I agree to abide by the terms and conditions set forth by the University.</p>
        <div class="row mt-3">
            <div class="form-group col-2">
                <label for="renterSignature" class="ml-3">Renter's Signature:</label>
                <input type="text" class="form-control" id="renterSignature" name="renterSignature" required>
            </div>
            <div class="form-group col-2">
                <label for="renterDate" class="ml-3">Date:</label>
                <input type="date" class="form-control" id="renterDate" name="renterDate" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.querySelectorAll('input[name="facility[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const otherFacilityDetails = document.getElementById('otherFacilityDetails');
            if (this.value === 'Other facility/ies' && this.checked) {
                otherFacilityDetails.style.display = 'block';
            } else if (this.value === 'Other facility/ies') {
                otherFacilityDetails.style.display = 'none';
            }
        });
    });

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('manpower-container');

    // Function to calculate and update the total manpower
    const updateTotalManpower = (entry) => {
        const rate = parseFloat(entry.querySelector('.manpower-rate').value) || 0;
        const hours = parseFloat(entry.querySelector('.manpower-hours').value) || 0;
        const total = rate * hours;
        entry.querySelector('.total-manpower').value = total.toFixed(2);
    };

    // Event delegation for dynamically added elements
    container.addEventListener('input', (event) => {
        if (event.target.classList.contains('manpower-rate') || event.target.classList.contains('manpower-hours')) {
            const entry = event.target.closest('.manpower-entry');
            updateTotalManpower(entry);
        }
    });

    // Add new entry form
    container.addEventListener('click', (event) => {
        if (event.target.classList.contains('add-more')) {
            const newEntry = document.querySelector('.manpower-entry').cloneNode(true);
            newEntry.querySelectorAll('input').forEach(input => input.value = '');
            newEntry.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            container.appendChild(newEntry);
        }
    });

    // Delete a particular entry
    container.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-particular')) {
            const entry = event.target.closest('.manpower-entry');
            if (container.querySelectorAll('.manpower-entry').length > 1) {
                entry.remove();
            } else {
                alert('You must have at least one entry.');
            }
        }
    });
});
</script>