<div id="updatePhotoModal" class="modal">
    <div class="up-modal-content row">
        <button type="button" class="existing-photo-close" id="upModalClose">&times;</button>
        <div class="preview-container col-3">
            <div class="preview-photo">
                <img src="" id="preview-img" alt="Photo Preview">
                <button id="removeImage"><span class="material-icons">delete</span></button>
            </div>
            <div class="row mt-3">
                <button class="upload-btn" id="uploadStockImage"><span class="material-icons">file_upload</span><p id="fileNameDisplay"></p></button>
                <form id="uploadForm" action="../sql/insert/stock-image.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <input type="file" name="image" id="fileInput" accept="image/*" required>
                </form>
                <button id="saveStockImage"><span class="material-icons">save</span></button>
            </div>
        </div>
        <div id="photoGallery" class="photo-gallery col-9"></div>
    </div>
</div>

<!-- <script src="../../src/js/modal/stock-card/update-image.js"></script> -->
<?php
include '../../src/js/modal/stock-card/update-image.php';
?>