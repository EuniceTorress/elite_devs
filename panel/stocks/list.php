<?php
include '../../modal/stocks/add-to-cart.php';
include '../../modal/stocks/view-cart.php';
?>
<div class="loading-indicator" id="loading-indicator">
    <div class="spinner"></div>
</div>

<div class="card-container"></div>

<div id="zoom-list-modal" class="modal">
    <span class="close" onclick="closeZoomModal()">&times;</span>
    <div class="modal-content zoom-list-modal-content">
        <img id="zoom-image" src="" class="zoomed-image">
    </div>
</div>
<?php
include '../../src/js/pages/stocks/list.php';
?>