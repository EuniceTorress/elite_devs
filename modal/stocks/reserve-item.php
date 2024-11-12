<div id="confirmation-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header d-flex">
            <h5>Reservation Details</h5>
            <p><b>Total Items: </b><span id="total-items"></span></p>
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="details-header">
                <div class="item-name col-5"><b>Item</b></div>
                <div class="item-quantity col-2"><b>Qty</b></div>
                <div class="item-price col-3"><b>Unit Price</b></div>
                <div class="item-total col-2"><b>Total Price</b></div>
            </div>
            <div id="selected-items-list" class="m-2"></div> 
            <p id="t-amount">Total Amount: <span id="modal-total-amount"></span></p>
        </div>
        <div class="modal-footer">
            <p id="date-time"><?php echo date('Y-m-d') . ' <span id="time">' . date('H:i:s') . '</span>'; ?></p>
            <button onclick="confirmReservation()">Submit<span class="material-icons">send</span></button>
        </div>
    </div>
</div>
