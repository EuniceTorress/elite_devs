<div class="modal" id="cartModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title d-flex align-items-center">
          <span class="material-icons">shopping_cart</span>
          <h5>Cart</h5>
        </div>
        <button type="button" class="close" id="closeCart">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="loadingIndicator" style="display: none;">Loading...</div> 
        <div id="cartItems"></div> 
      </div>
        <div id="seeMoreContainer" class="modal-footer">
          <button id="seeMoreBtn" class="btn btn-link">View Cart</button>
        </div>
    </div>
  </div>
</div>

<?php
include '../../src/js/modal/view-cart/modal.php';
?>
