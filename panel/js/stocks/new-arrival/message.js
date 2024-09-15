export function showMessageModal(message, messageModal) {
    const messageText = document.getElementById("messageText");
    messageText.textContent = message;
    messageModal.style.display = "block";
  }
  