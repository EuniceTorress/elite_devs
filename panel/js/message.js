$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    if (message) {
        $('#modal-body-content').text(decodeURIComponent(message));
        $('#messageModal').modal('show');
    }
});
