<?php
include '../../modal/facilities/add-facility.php';
include '../../modal/facilities/edit-facility.php';
?>
<div id="table-container">
  <table id="all-table">
    <thead>
      <tr>
        <th class="col-3">ID</th>
        <th class="col-3">Facility</th>
        <th class="col-2">Price</th>
        <th class="col-2">Rate</th>
        <th class="col-2">Status</th>
      </tr>
    </thead>
    <tbody id="facility-data">
    </tbody>
  </table>
</div>

<script>
    let isFacilityDataLoaded = false;

    function fetchFacilitiesData() {
        fetch('../../sql/fetch/facility.php')
            .then(res => {
                if (!res.ok) throw new Error('Network response not ok');
                return res.json();
            })
            .then(data => {
                if (!isFacilityDataLoaded) {
                    isFacilityDataLoaded = true;
                }
                populateFacilityTable(data);
            })
            .catch(err => console.error('Error fetching facility data:', err));
    }

    function populateFacilityTable(data) {
    let rows = data.length > 0 ? data.map(fac => {
        let rateSelector = '';

        if (fac.rate.length > 1) {
            rateSelector = `<select onchange="updatePrice(this)">
                ${fac.rate.map(rateOption => {
                    const [rateType, rateId, ratePrice] = rateOption.split(',');
                    return `<option value="${ratePrice}">${rateType}</option>`;
                }).join('')}
            </select>`;
        } else if (fac.rate.length === 1) {
            const [rateType, rateId, ratePrice] = fac.rate[0].split(',');
            rateSelector = `${rateType}`;
        } else {
            rateSelector = fac.price;
        }

        let statusText;
        switch (fac.status) {
            case '0':
                statusText = 'Available';
                break;
            case '1':
                statusText = 'Occupied';
                break;
            default:
                statusText = 'Under Maintenance'; 
        }

        return `
            <tr data-id="${fac.id}" data-facility="${fac.facility}" data-price="${fac.price}" data-status="${fac.status}">
                <td>${fac.id}</td>
                <td>${fac.facility}</td>
                <td>${fac.price}</td>
                <td>${rateSelector}</td>
                <td>${statusText}
                <i class="material-icons view-icon" onclick="openEditModal({
                    id: '${fac.id}',
                    name: '${fac.facility}',
                    price: '${fac.price}',
                    status: '${fac.status}',
                    availability: '${fac.availability}',
                    rate: '${fac.rate}'
                })">visibility</i>
                </td>
            </tr>`;
    }).join('') : '<tr><td colspan="6">No facility available</td></tr>';
    
    document.getElementById('facility-data').innerHTML = rows;
}

    function updatePrice(selectElement) {
        const priceCell = selectElement.closest('tr').querySelector('td:nth-child(3)');
        priceCell.textContent = selectElement.value;
    }

    fetchFacilitiesData();
</script>
