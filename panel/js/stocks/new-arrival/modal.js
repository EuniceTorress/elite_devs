export function showModal(modal, overlay) {
    overlay.style.display = "block";
    modal.style.display = "block";
  }
  
  export function hideModal(modal, overlay, messageModal, clearFields) {
    overlay.style.display = "none";
    modal.style.display = "none";
    messageModal.style.display = "none";
    clearFields();
  }
  