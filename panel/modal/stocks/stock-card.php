<style>
    #stockDetailsModal {
        display: none;
        position: fixed;
        z-index: 3;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    #stockDetailsModal .modal-content {
        background-color: white;
        padding: 10px 25px;
        border: 1px solid #800000;
        width: 80%;
        max-width: 60%;
        display: flex;
        border-radius: 10px;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #stockDetailsModal .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    #stockDetailsModal .modal-title {
        font-size: 1.5rem;
        color: #800000; 
        margin: 0;
    }

    #stockDetailsModal .close-button {
        color: #aaa;
        font-size: 1.5rem;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
        outline: none !important;
        box-shadow: none !important;
    }

    #stockDetailsModal .close-button:hover,
    #stockDetailsModal .close-button:focus {
        color: #800000;
        text-decoration: none;
    }

    .image-container {
        width: 200px;
        height: 200px; 
        margin: 10px 20px 20px 20px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        text-align: center;
        align-content: center;
        justify-content: center;
        border-radius: 10px;
        background-color: #f0f0f0;
        border: 1px solid #800000; 
    }

    .image-container img {
        width: 100%;
        height: auto;
        max-height: 100%;
        object-fit: cover;
    }

    .image-btn-wrapper {
        position: absolute;
        bottom: 5%; 
        left: 2%;
        display: none;
        gap: 10px;
    }

    .image-btn-wrapper button {
        background-color: #800000; 
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .image-btn-wrapper button:hover {
        background-color: #550000; 
    }

    .edit-form {
        display: none;
        flex-direction: column;
    }

    .edit-icon {
        cursor: pointer;
        color: #800000; 
        font-size: 20px;
        position: absolute;
        right: 5.5%;
        opacity: 0.5;
    }

    .edit-icon:hover {
        opacity: 1;
    }

    .edit-form input {
        padding: 8px;
        border: 0.5px solid rgba(128, 5, 5, 0.4);
        border-radius: 10px;
        background-color: #f9f9f9;
        color: #333;
        font-size: 0.8rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 90%;
        margin-bottom: 10px;
    }

    .edit-form input::placeholder {
        opacity: 0.4;
        color: #800000;
    }

    .edit-form input:focus {
        outline: none;
        border-color: #800000;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.3);
    }


    .edit-form button {
        align-self: flex-end;
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        background-color: #800000; 
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .edit-form button:hover {
        background-color: #550000; 
    }

    .details-container.hidden {
        display: none; 
    }

    .image-viewer-overlay {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9); 
        justify-content: center;
        align-items: center;
    }

    .overlay-close {
        position: absolute;
        top: 20px;
        right: 40px;
        font-size: 60px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        outline: none !important;
        box-shadow: none !important;
    }

    .overlay-close:hover {
        color: #800000; 
    }

    .image-viewer-overlay img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #existingPhotoModal {
        display: none;
        position: fixed;
        z-index: 4;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    .existing-photo-content {
        position: relative;
        background-color: white;
        padding: 20px;
        padding-top: 35px;
        border-radius: 10px;
        max-width: 60%;
        max-height: 80%;
        overflow: hidden;
    }

    .photo-gallery {
        display: flex;
        overflow-x: auto;
        gap: 10px;
        padding: 10px 0;
    }

    .photo-thumbnail {
        min-width: 150px;
        cursor: pointer;
    }

    .photo-thumbnail img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .existing-photo-close {
        position: absolute;
        top: 3px;
        right: 20px;
        font-size: 30px;
        font-weight: bold;
        color: #aaa;
        background: none;
        border: none;
        cursor: pointer;
        outline: none !important;
        box-shadow: none !important;
    }

    .existing-photo-close:hover {
        color: maroon;
    }
</style>

<div class="modal" id="stockDetailsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="stockDetailsLabel">
                <span id="stockModalItem"></span>
            </h4>
            <button id="stockDetailsCloseButton" type="button" class="close-button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row">
            <i class="fas fa-pencil-alt edit-icon" id="editStockDetails"></i>
            <div class="image-part">
                <div class="image-container">
                    <img id="stockModalImage" src="" alt="Stock Image">
                </div>
                <div class="image-btn-wrapper">
                    <button class="upload-btn" id="uploadStockImage">New Photo</button>
                    <button class="choose-btn" id="choosePhotoButton">Existing Photo</button>
                    <input type="file" id="imageUpload" accept="image/*" style="display: none;">
                </div>
            </div>
            <div class="details-container" id="detailsContainer">
                <p><strong>Stock No:</strong> <span id="stockModalStockNo"></span></p>
                <p><strong>Category:</strong> <span id="stockModalCategory"></span></p>
                <p><strong>Price:</strong> <span id="stockModalPrice"></span></p>
                <p><strong>Quantity:</strong> <span id="stockModalQty"></span></p>
            </div>
            <div class="edit-form" id="editForm">
                <input type="text" id="editName" placeholder="Stock Name">
                <input type="text" id="editStockNo" placeholder="Stock No">
                <input type="text" id="editCategory" placeholder="Category">
                <input type="text" id="editPrice" placeholder="Price">
                <input type="text" id="editQty" placeholder="Quantity">
                <button id="saveChangesButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div id="existingPhotoModal">
    <div class="existing-photo-content">
        <button type="button" class="existing-photo-close" id="existingPhotoClose">&times;</button>
        <div class="photo-gallery">
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 1">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 2">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
            <div class="photo-thumbnail">
                <img src="https://via.placeholder.com/150" alt="Photo 3">
            </div>
        </div>
    </div>
</div>

<div class="image-viewer-overlay" id="imageViewerOverlay">
    <span class="overlay-close" id="overlayClose">&times;</span>
    <img id="overlayImage" src="" alt="Viewer Image">
</div>

<script>

    function viewImage() {
        const overlay = document.getElementById('imageViewerOverlay');
        const overlayImage = document.getElementById('overlayImage');
        const stockImage = document.getElementById('stockModalImage');

        overlayImage.src = stockImage.src;
        overlay.style.display = "flex";
    }

    function closeOverlay() {
        document.getElementById('imageViewerOverlay').style.display = "none";
    }

    function editStockDetails() {
        document.getElementById('detailsContainer').style.display = 'none';
        document.getElementById('editForm').style.display = 'flex'; 
        document.querySelector('.image-btn-wrapper').style.display = 'flex';
        document.getElementById('editStockDetails').style.display = 'none';
    }

    function saveChanges() {
        const stockId = document.getElementById('stockModalStockNo').innerText;
        const stockData = JSON.parse(localStorage.getItem('stockData'));
        const updatedData = {
            name: document.getElementById('editName').value,
            stock_no: document.getElementById('editStockNo').value,
            category: document.getElementById('editCategory').value,
            unit_price: document.getElementById('editPrice').value,
            quantity: document.getElementById('editQty').value,
            image: document.getElementById('stockModalImage').src
        };

        const index = stockData.findIndex(stock => stock.stock_no == stockId);
        if (index !== -1) {
            stockData[index] = updatedData;
            localStorage.setItem('stockData', JSON.stringify(stockData));

            document.getElementById('stockModalItem').innerText = updatedData.name;
            document.getElementById('stockModalStockNo').innerText = updatedData.stock_no;
            document.getElementById('stockModalCategory').innerText = updatedData.category;
            document.getElementById('stockModalPrice').innerText = `₱ ${parseFloat(updatedData.unit_price).toFixed(2)}`;
            document.getElementById('stockModalQty').innerText = updatedData.quantity;

            document.getElementById('editForm').style.display = 'none';
            document.getElementById('detailsContainer').style.display = 'block';
            document.querySelector('.image-btn-wrapper').style.display = 'none'; 
        }

        document.getElementById('editStockDetails').style.display = 'block';
    }

    function selectPhoto(event) {
        if (event.target.tagName === 'IMG') {
            const selectedImageSrc = event.target.src;
            document.getElementById('stockModalImage').src = selectedImageSrc;
            document.getElementById('existingPhotoModal').style.display = 'none';
        }
    }
    
    const imageUpload = document.getElementById('imageUpload');
    const uploadStockImageButton = document.getElementById('uploadStockImage');
    const choosePhotoButton = document.getElementById('choosePhotoButton');
    const existingPhotoModal = document.getElementById('existingPhotoModal');
    const existingPhotoClose = document.getElementById('existingPhotoClose');

    const modal = document.getElementById('stockDetailsModal');
    const modalContent = document.querySelector('#stockDetailsModal .modal-content');

    const modalCloseButton = document.getElementById('stockDetailsCloseButton');

    function closeModal() {
        modal.style.display = "none";
        document.getElementById('editForm').style.display = "none";
        document.getElementById('detailsContainer').style.display = "block";
        document.querySelector('.image-btn-wrapper').style.display = 'none';
    }

    modalCloseButton.onclick = function(event) {
        event.preventDefault(); 
        closeModal();
    };

    modalContent.onclick = function(event) {
        event.stopPropagation();
    };
    
    function closeModal() {
        modal.style.display = "none";
        document.getElementById('editForm').style.display = "none";
        document.getElementById('detailsContainer').style.display = "block";
        document.querySelector('.image-btn-wrapper').style.display = 'none';
    }

    function openModal(stockId) {
        const stockData = JSON.parse(localStorage.getItem('stockData')).find(stock => stock.stock_no == stockId);
        document.getElementById('stockModalItem').innerText = stockData.name;
        document.getElementById('stockModalStockNo').innerText = stockData.stock_no;
        document.getElementById('stockModalCategory').innerText = stockData.category;
        document.getElementById('stockModalPrice').innerText = `₱ ${parseFloat(stockData.unit_price).toFixed(2)}`;
        document.getElementById('stockModalQty').innerText = stockData.quantity;
        document.getElementById('stockModalImage').src = stockData.image || 'placeholder-image.jpg';

        document.getElementById('editName').value = stockData.name;
        document.getElementById('editStockNo').value = stockData.stock_no;
        document.getElementById('editCategory').value = stockData.category;
        document.getElementById('editPrice').value = stockData.unit_price;
        document.getElementById('editQty').value = stockData.quantity;

        document.getElementById('editStockDetails').style.display = 'block';
        modal.style.display = "flex";
    }

    uploadStockImageButton.onclick = () => imageUpload.click();
    choosePhotoButton.onclick = () => existingPhotoModal.style.display = 'flex';
    existingPhotoClose.onclick = () => existingPhotoModal.style.display = 'none';
    existingPhotoModal.addEventListener('click', selectPhoto);
    document.getElementById('overlayClose').addEventListener('click', closeOverlay);
    document.getElementById('editStockDetails').addEventListener('click', editStockDetails);
    document.getElementById('saveChangesButton').addEventListener('click', saveChanges);
</script>
