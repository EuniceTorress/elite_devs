<div id="modalOverlay" class="modal-overlay"></div>

<div id="newArrival" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header m-0">
                <div class="form-group row col-12 m-0">
                  <h5 class="mr-5" id="exampleModalLongTitle">New Arrival</h5>
                  <p class="lb">Stocks to input :</p>
                  <input type="number" class="form-control col-1" id="stockCount" name="stockCount" min="1" required>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div class="modal-body">
                <form id="stocksForm" action="../sql/insert/stocks.php" method="POST" enctype="multipart/form-data">
                    <div id="stocksFields"></div>
                    <input type="hidden" id="formStockCount" name="stockCount">
            </div>
            <div class="modal-footer">
                <p class="lb"><?php echo date('Y-m-d') . ' <span id="time">' . date('H:i:s') . '</span>'; ?></p>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="messageModal" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="messageText">Your message will be displayed here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
