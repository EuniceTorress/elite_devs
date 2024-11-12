<style>
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 20px;
}

.form-container .lb {
    margin-top: 20px;
    text-align: justify;
}

.form-group label {
    font-weight: bold;
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border: 0.5px solid rgba(128, 5, 5, 0.4);
    border-radius: 10px;
    background-color: #FFFFFF;
    color: #000000;
    font-size: 0.8rem;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-control::placeholder {
    font-size: 0.8rem;
    color: #6c757d;
}

.checkbox-group label {
    margin-right: 20px;
    display: inline-block;
}

.amount {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
    padding: 5px 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #f8f9fa;
    display: inline-block;
}

.amount .value {
    color: #007bff;
}

@media (max-width: 768px) {
    .amount {
        font-size: 14px;
        padding: 4px 8px;
    }
}

@media (max-width: 576px) {
    .amount {
        font-size: 12px;
        padding: 3px 6px;
    }
}

#facility-container .form-group i,
#manpower-container .form-group i {
    font-size: 10px;
    margin-right: 5px;
}

#facility-container .form-group button,
#manpower-container .form-group button {
    font-size: 13px;
    border-radius: 50px;
    outline: none;
    box-shadow: none;
}

.other-facility-details,
.other-manpower-details {
    display: none;
}

.form-group select {
    font-size: 14px;
    padding: 5px;
    width: 100%;
    box-sizing: border-box;
    text-overflow: ellipsis;
}

.form-group select option {
    padding: 10px;
}

.form-container #facility-container .btn-danger,
.form-container #manpower-container .btn-danger {
    height: 2.3rem;
    font-size: 13px;
    border-radius: 50px;
    outline: none;
    box-shadow: none;
    margin-top: 25px;
    margin-left: 20px;
}

.submit-container {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}   

.submit-container .btn-success {
    border-radius: 50px;
    outline: none;
    box-shadow: none;
    width: 120px;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    background-color: transparent;
    border: none;
    font-size: 20px;
    color: #000;
    cursor: pointer;
    z-index: 1000;
    outline: none !important;
    box-shadow: none !important;
}

.close-btn:hover {
    color: maroon;
}

</style>
    <div class="modal fade " id="rentFacilityModal" tabindex="-1" aria-labelledby="rentFacilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 90%;">
            <div class="modal-content">
                <button type="button" class="close-btn" id="closeRentFacilityModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="form-container py-3">
                        <h2>Application Form for Renting University Facility</h2>
                        <form class="mx-3 px-5">
                        <div class="row mt-5">
                                <p class="lb col-2">Name of Renter:</p>
                            <div class="form-group col-2">
                                <label for="firstName">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="middleName">Middle Name:</label>
                                <input type="text" class="form-control" id="middleName" name="middleName" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="lastName">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="suffix">Suffix:</label>
                                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Optional">
                            </div>
                            <div class="form-group col-2 ml-auto">
                                <label for="contactNumber">Contact Number:</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
                            </div>
                        </div>
                        <div class="row">
                            <p class="lb col-2">Address:</p>
                            <div class="form-group col-2">
                                <label for="province">Province</label>
                                <select class="form-control" id="province" name="province" required>
                                    <option value="">Select Province</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="municipality">Municipality</label>
                                <select class="form-control" id="municipality" name="municipality" required>
                                    <option value="">Select Municipality</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="barangay">Barangay</label>
                                <select class="form-control" id="barangay" name="barangay" required>
                                    <option value="">Select Barangay</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="street">Street</label>
                                <select class="form-control" id="street" name="street">
                                    <option value="">Select Street</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <p class="lb col-2">Event Details:</p>
                            <div class="form-group col-2">
                                <label for="expectedNumberOfGuests">No. of Guests:</label>
                                <input type="number" class="form-control eg" id="expectedNumberOfGuests" name="expectedNumberOfGuests" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="dateOfEvent">Date:</label>
                                <input type="date" class="form-control" id="dateOfEvent" name="dateOfEvent" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="timeOfEvent">Time:</label>
                                <input type="time" class="form-control" id="timeOfEvent" name="timeOfEvent" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="purpose">Purpose:</label>
                                <input type="text" class="form-control" id="purpose" name="purpose" required>
                            </div>
                        </div>
                        <div id="facility-container">
                            <div class="row mt-4">
                                <h4>Facility/ies to be Rented</h4>
                                <div class="form-group col-2">
                                    <button type="button" class="btn btn-primary" id="addFacility"><i class="fas fa-plus"></i> Add more</button>
                                </div>
                            </div>
                            <div class="facility-entry">
                                <div class="row">
                                    <div class="ml-3 form-group col-5">
                                        <label for="facilities">Facilities:</label>
                                        <select class="form-control" name="facilities[]" required>
                                            <option value="">Select Facility</option>
                                            <option value="Amphitheater">Amphitheater</option>
                                            <option value="Multimedia Room">Multimedia Room</option>
                                            <option value="Classroom">Classroom</option>
                                            <option value="Covered Court">Covered Court</option>
                                            <option value="Gymnasium with aircon">Gymnasium with aircon</option>
                                            <option value="Gymnasium without aircon">Gymnasium without aircon</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="facilityHours">No. of Hours:</label>
                                        <input type="number" class="form-control facility-hours" name="facilityHours[]" required>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="facilityCost">Cost:</label>
                                        <input type="text" class="form-control facility-cost" name="facilityCost[]" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="totalFacilityCost">Total Cost:</label>
                                        <input type="text" class="form-control facility-cost" name="totalFacilityCost" readonly>
                                    </div>
                                        <button type="button" class="btn btn-danger remove-entry"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <div class="other-facility-details">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="facilityOtherDetails">Please specify:</label>
                                            <input type="text" class="form-control" name="facilityOtherDetails[]" placeholder="Specify the facility">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="manpower-container">
                            <div class="row mt-4">
                                <h4>Manpower Required</h4>
                                <div class="form-group col-2">
                                    <button type="button" class="btn btn-primary" id="addManpower"><i class="fas fa-plus"></i> Add more</button>
                                </div>
                            </div>
                            <div class="manpower-entry">
                                <div class="row">
                                    <div class="ml-3 form-group col-5">
                                        <label for="manpower">Manpower:</label>
                                        <select class="form-control" name="manpower[]" required>
                                            <option value="">Select Manpower</option>
                                            <option value="Electrician">Electrician</option>
                                            <option value="Technician">Technician</option>
                                            <option value="Janitors">Janitors</option>
                                            <option value="Security Guard">Security Guard</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="manpowerHours">No. of Hours:</label>
                                        <input type="number" class="form-control manpower-hours" name="manpowerHours[]" required>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="manpowerCost">Cost:</label>
                                        <input type="text" class="form-control manpower-cost" name="manpowerCost[]" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="totalFacilityCost">Total Cost:</label>
                                        <input type="text" class="form-control facility-cost" name="totalFacilityCost" readonly>
                                    </div>
                                        <button type="button" class="btn btn-danger remove-entry"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <h4>Other Requirements</h4>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="otherRequirements" name="otherRequirements" rows="4"></textarea>
                        </div>
                        <div class="submit-container">
                            <button type="submit" class="btn btn-success">Submit<i class="ml-2 fas fa-arrow-right"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var addFacilityBtn = document.getElementById('addFacility');
            var facilityContainer = document.getElementById('facility-container');
            var addManpowerBtn = document.getElementById('addManpower');
            var manpowerContainer = document.getElementById('manpower-container');
            var facilityEntryHtml = facilityContainer.querySelector('.facility-entry').innerHTML;
            var manpowerEntryHtml = manpowerContainer.querySelector('.manpower-entry').innerHTML;
            var closeRentFacilityModal = document.getElementById('closeRentFacilityModal');

            closeRentFacilityModal.addEventListener('click', function () {
                $('#rentFacilityModal').modal('hide');
            });
            $('#rentFacilityModal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
            });


            addFacilityBtn.addEventListener('click', function () {
                var newFacilityEntry = document.createElement('div');
                newFacilityEntry.classList.add('facility-entry');
                newFacilityEntry.innerHTML = facilityEntryHtml;
                facilityContainer.appendChild(newFacilityEntry);
                setupRemoveButton(newFacilityEntry);
                setupOtherFacilityListener(newFacilityEntry);
            });

            addManpowerBtn.addEventListener('click', function () {
                var newManpowerEntry = document.createElement('div');
                newManpowerEntry.classList.add('manpower-entry');
                newManpowerEntry.innerHTML = manpowerEntryHtml;
                manpowerContainer.appendChild(newManpowerEntry);
                setupRemoveButton(newManpowerEntry);
                setupOtherManpowerListener(newManpowerEntry);
            });

            function setupRemoveButton(container) {
                var removeBtn = container.querySelector('.btn-danger');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function () {
                        container.remove();
                    });
                }
            }

            function setupOtherFacilityListener(container) {
                var selectFacility = container.querySelector('select[name="facilities[]"]');
                var otherFacilityInput = container.querySelector('.other-facility-details');
                selectFacility.addEventListener('change', function () {
                    if (this.value === 'Other') {
                        otherFacilityInput.style.display = 'block';
                    } else {
                        otherFacilityInput.style.display = 'none';
                    }
                });
            }

            function setupOtherManpowerListener(container) {
                var selectManpower = container.querySelector('select[name="manpower[]"]');
                var otherManpowerInput = container.querySelector('.other-manpower-details');
                selectManpower.addEventListener('change', function () {
                    if (this.value === 'Other') {
                        otherManpowerInput.style.display = 'block';
                    } else {
                        otherManpowerInput.style.display = 'none';
                    }
                });
            }

            $('#openReservationModal').click(function (e) {
                e.preventDefault();
                $('#rentFacilityModal').modal('show');
            });

            document.querySelector('form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formErrors = document.getElementById('formErrors');
                formErrors.style.display = 'none';
                formErrors.innerHTML = '';
                var form = e.target;

                if (!form.checkValidity()) {
                    formErrors.style.display = 'block';
                    formErrors.innerHTML = 'Please fill out all required fields.';
                    return;
                }

                alert('Form submitted successfully!');
            });

            setupOtherFacilityListener(facilityContainer.querySelector('.facility-entry'));
            setupOtherManpowerListener(manpowerContainer.querySelector('.manpower-entry'));
        });
    </script>
    