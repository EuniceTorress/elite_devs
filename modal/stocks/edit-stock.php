<?php
include '../../src/css/modal/edit-stock.php';
?>
<div id="info-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-stock-name"></p>
        <div class="row mb-1">
            <div class="col-5">
                <div id="modal-image-container">
                    <img id="modal-image" src="" alt="Stock Image">
                </div>
                <span id="update-pic" class="material-icons">camera_alt</span>
            </div>
            <div class="col-7 mt-2">
                <div id="stock-details">
                    <p id="modal-description"></p>
                    <p id="modal-category"></p>
                    <p id="modal-price"></p>
                    <p id="modal-cost"></p>
                    <div class="mqty"><p id="modal-quantity"></p><div id="new-entry-s"></div></div>
                </div>

                <form id="edit-stock-form">
                    <div class="d-flex name-field">
                        <label for="edit-name">Name: </label>
                        <input type="text" id="edit-name" name="edit-name" value="">
                    </div>
                    <div class="mt-5">
                        <label for="edit-description">Description:</label>
                        <input type="text" id="edit-description" name="description" value="">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="edit-price">Price:</label>
                            <input type="number" id="edit-price" name="price" value="">
                        </div>
                        <div class="col-6 c2">
                            <label for="edit-cost">Cost:</label>
                            <input type="number" id="edit-cost" name="cost" value="">
                        </div>
                    </div>
            </div>
        </div>
        <div class="d-flex id"><span id="span-id">ID:</span>
            <p id="modal-id"></p></div>
        <span id="back-btn" class="material-icons">clear</span>
        <input type="hidden" id="original-stock-number" name="original_stock_number" value="">
        <button type="submit" id="save-btn"><span class="material-icons">save</span></button>
        </form>
        <span class="material-icons" id="edit-btn">edit_note</span>
    </div>
</div>

<div id="message-container"></div>

<div id="zoom-modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="zoomed-image">
</div>

<script src="../../src/js/modal/stock-card/image-viewer.js"></script>
