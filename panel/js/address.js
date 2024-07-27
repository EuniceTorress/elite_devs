const addressData = {
    "Province1": {
        "Municipality1": {
            "Barangay1": ["Street1", "Street2"],
            "Barangay2": ["Street3", "Street4"]
        },
        "Municipality2": {
            "Barangay3": ["Street5", "Street6"]
        }
    },
    "Province2": {
        "Municipality3": {
            "Barangay4": ["Street7", "Street8"]
        },
        "Municipality4": {
            "Barangay5": ["Street9", "Street10"]
        }
    }
};

const provinceSelect = document.getElementById('province');
const municipalitySelect = document.getElementById('municipality');
const barangaySelect = document.getElementById('barangay');
const streetSelect = document.getElementById('street');

// Populate Provinces
Object.keys(addressData).forEach(province => {
    const option = document.createElement('option');
    option.value = province;
    option.textContent = province;
    provinceSelect.appendChild(option);
});

provinceSelect.addEventListener('change', function() {
    municipalitySelect.innerHTML = '<option value="">Select Municipality</option>';
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    streetSelect.innerHTML = '<option value="">Select Street</option>';

    const selectedProvince = this.value;
    if (selectedProvince) {
        const municipalities = addressData[selectedProvince];
        Object.keys(municipalities).forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality;
            option.textContent = municipality;
            municipalitySelect.appendChild(option);
        });
    }
});

municipalitySelect.addEventListener('change', function() {
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    streetSelect.innerHTML = '<option value="">Select Street</option>';

    const selectedProvince = provinceSelect.value;
    const selectedMunicipality = this.value;
    if (selectedProvince && selectedMunicipality) {
        const barangays = addressData[selectedProvince][selectedMunicipality];
        Object.keys(barangays).forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        });
    }
});

barangaySelect.addEventListener('change', function() {
    streetSelect.innerHTML = '<option value="">Select Street</option>';

    const selectedProvince = provinceSelect.value;
    const selectedMunicipality = municipalitySelect.value;
    const selectedBarangay = this.value;
    if (selectedProvince && selectedMunicipality && selectedBarangay) {
        const streets = addressData[selectedProvince][selectedMunicipality][selectedBarangay];
        streets.forEach(street => {
            const option = document.createElement('option');
            option.value = street;
            option.textContent = street;
            streetSelect.appendChild(option);
        });
    }
});
