<div id="stock-modal" class="modal">
    <div class="modal-content">
        <span class="close col-1" onclick="closeModal()">&times;</span>
        <div class="row">
            <div class="col-4">
                <img id="modal-image" src="" alt="" class="modal-image">
            </div>
            <div class="col-8">
                <form id="modal-form" method="post">
                    <h4 id="modal-product-name" class="product-name"></h4>
                    <div class="containersss">
                        <div id="description-container"></div>
                        <div id="others-container"></div>
                    </div>
                    <span id="modal-product-price"></span>
                    <div class="quantity-field">
                        <span class="material-icons" id="dec-qty">remove</span>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" />
                        <input type="hidden" id="stock_no" name="stock_no">
                        <span class="material-icons" id="inc-qty">add</span>
                    </div>
            </div>
        </div>
        <div class="d-flex product-qty">
            <p>Available Stock/s:</p><span id="modal-product-quantity"></span>
                <button type="submit" id="cart-submit" class="btn-add-to-cart">
                    Add to Cart <span class="material-icons">add_shopping_cart</span>
                </button>
        </div>
        </form>
    </div>
</div>

<?php
include '../../src/js/modal/add-to-cart/modal.php';
include '../../src/js/modal/add-to-cart/quantity.php';
?>
