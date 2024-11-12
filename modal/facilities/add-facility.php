<div id="facilityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Add Facility</h5>
            <p class="lb text-right">No. to input :</p>
            <input type="number" id="facilityCount" name="facilityCount" min="1" max="10" required>
            <span class="close">&times;</span>
        </div>
        <form id="facilityForm">
            <div class="facilityField" id="facilityFieldContainer"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
var modal = document.getElementById("facilityModal");
var btn = document.getElementById("addFacility");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.classList.add("active");
}

span.onclick = function() {
    modal.classList.remove("active"); 
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.classList.remove("active");
    }
}

document.getElementById("facilityCount").addEventListener('input', function() {
    var count = this.value;
    var container = document.getElementById("facilityFieldContainer");

    var existingValues = {};
    for (var i = 0; i < container.children.length; i++) {
        existingValues[i] = {
            name: document.getElementById(`facilityName${i}`)?.value || "",
            price: document.getElementById(`facilityPrice${i}`)?.value || "",
            rateType: document.getElementById(`rateType${i}`)?.value || "",
            customRateType: document.getElementById(`customRateType${i}`)?.value || ""
        };
    }

    container.innerHTML = ""; 

    if (count < 1) {
        alert("Facility count cannot be less than 1.");
        this.value = 1;
        count = 1;
    } else if (count > 10) {
        alert("The maximum number of facilities is 10.");
        this.value = 10;
        count = 10;
    }

    for (var i = 0; i < count; i++) {
        container.innerHTML += `
            <div class="facility-row">
                <p class="lb">${i + 1}.</p>
                <div class="form-group fname col-5">
                    <label for="facilityName${i}">Facility Name:</label>
                    <input type="text" id="facilityName${i}" name="facilityName${i}" required>
                </div>
                <div class="form-group fprice col-2">
                    <label for="facilityPrice${i}">Price:</label>
                    <input type="number" id="facilityPrice${i}" name="facilityPrice${i}" required min="0" step="0.01" placeholder="0.00">
                </div>
                <div class="form-group rtype col-4">
                    <label for="rateType${i}">Rate Type:</label>
                    <div class="frate">
                        <select id="rateType${i}" name="rateType${i}" onchange="toggleRateInput(${i})" required>
                        </select>
                        <input type="text" class="crtype" id="customRateType${i}" name="customRateType${i}" placeholder="Specify rate type" style="display: none;">
                    </div>
                </div>
                <hr>
            </div>
        `;

        populateRateTypes(i, existingValues[i]);
    }
});

function populateRateTypes(index, existingValue) {
    fetch('../../sql/fetch/facility-rate.php') 
        .then(response => response.json())
        .then(data => {
            var rateTypeSelect = document.getElementById(`rateType${index}`);
            rateTypeSelect.innerHTML = ""; 

            data.forEach(type => {
                var option = document.createElement("option");
                option.value = type.rate_type;
                option.text = type.rate_type;
                rateTypeSelect.appendChild(option);
            });

            var otherOption = document.createElement("option");
            otherOption.value = "";
            otherOption.text = "Other";
            rateTypeSelect.appendChild(otherOption);

            if (existingValue) {
                document.getElementById(`facilityName${index}`).value = existingValue.name;
                document.getElementById(`facilityPrice${index}`).value = existingValue.price;
                rateTypeSelect.value = existingValue.rateType;

                if (existingValue.rateType === "") {
                    document.getElementById(`customRateType${index}`).style.display = "inline";
                    document.getElementById(`customRateType${index}`).value = existingValue.customRateType;
                }
            }
        })
        .catch(error => {
            console.error("Error fetching rate types:", error);
        });
}

function toggleRateInput(index) {
    var rateTypeSelect = document.getElementById(`rateType${index}`);
    var customRateTypeInput = document.getElementById(`customRateType${index}`);

    if (rateTypeSelect.value === "") {
        rateTypeSelect.classList.add('wd');
        customRateTypeInput.style.display = "inline";
    } else {
        rateTypeSelect.classList.remove('wd');
        customRateTypeInput.style.display = "none";
    }
}

document.getElementById("facilityForm").onsubmit = function(e) {
    e.preventDefault(); 

    var facilities = [];
    var valid = true;
    var count = document.getElementById("facilityCount").value;

    for (var i = 0; i < count; i++) {
        var name = document.getElementById(`facilityName${i}`).value;
        var price = document.getElementById(`facilityPrice${i}`).value;
        var rateType = document.getElementById(`rateType${i}`).value;
        var customRateType = document.getElementById(`customRateType${i}`).value;

        if (!price || isNaN(price) || price <= 0) {
            alert(`Please enter a valid price for facility ${i + 1}.`);
            valid = false;
            break;
        }

        facilities.push({
            name,
            price,
            rateType: rateType || customRateType 
        });
    }

    if (valid) {
        fetch('../../sql/insert/add-facility.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(facilities)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Facilities added successfully!");
                document.getElementById("facilityForm").reset();
                modal.style.display = "none"; 
                fetchFacilitiesData();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error submitting the form:", error);
            alert("An error occurred. Please try again.");
        });
    }
}
</script>
