<div id="reservationDetailsModal" class="unique-modal" style="display:none;">
  <div class="modal-content">
    <div class="modal-header">
      <h5>ID: <span id="modalReservationId"></span></h5>
      <button class="close-btn" onclick="closeReservationModal()">×</button>
    </div>
    <div class="modal-body">
        <div class="customer">
            <div class="user-profile">
                <img src="../../src/img/no-image.jpg" alt="User Profile" class="profile-img">
            </div>
            <div>
                <p class="cstmr"><strong>Customer Name: </strong> <span id="modalName"></span></p>
                <p><span id="modalRole"></span></p>
            </div>
        </div>
        <div class="details-header">
            <div class="item-name col-5"><b>Item(s)</b></div>
            <div class="item-quantity col-2"><b>Qty</b></div>
            <div class="item-price col-3"><b>Unit Price</b></div>
            <div class="item-total col-2"><b>Total</b></div>
        </div>
        <div id="selected-items-list" class="m-2"></div> 
        <p id="t-amount">Total Amount: <span id="modal-total-amount"></span></p>
    </div>
    <div class="modal-footer">
      <button class="reject-btn" onclick="rejectReservation()">Reject</button>
      <button class="approve-btn" onclick="approveReservation()">Approve</button>
    </div>
  </div>
</div>

<script>
  function openReservationModal(row) {
    document.getElementById('modalName').innerText = row.name;
    document.getElementById('modalRole').innerText = row.role;
    document.getElementById('modalReservationId').innerText = row.id;

    const selectedItemsList = document.getElementById('selected-items-list');
    selectedItemsList.innerHTML = '';
    
    row.details.forEach(detail => {
      const itemRow = document.createElement('div');
      itemRow.className = 'item-row';
      itemRow.innerHTML = `
        <div class="item-name col-5">${detail.item_name} (${detail.description})</div>
        <div class="item-quantity col-2">${detail.quantity}</div>
        <div class="item-price col-3">₱ ${detail.price}</div>
        <div class="item-total col-2">₱ ${(detail.price * detail.quantity).toFixed(2)}</div>
      `;
      selectedItemsList.appendChild(itemRow);
    });

    document.getElementById('modal-total-amount').innerText = `₱ ${row.total_price}`;

    const modal = document.getElementById('reservationDetailsModal');
    modal.style.display = "flex";
    setTimeout(() => modal.classList.add('show'), 10);
  }

  function closeReservationModal() {
    const modal = document.getElementById('reservationDetailsModal');
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }

  function approveReservation() {
    closeReservationModal();
  }

  function rejectReservation() {
    closeReservationModal();
  }
</script>

<style>
  .item-row {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
  }

  .item-name, .item-quantity, .item-price, .item-total {
    padding: 8px;
  }
</style>
