  $(document).ready(function () {
    $('#stock-card').on('show.bs.modal', function (event) {
      var button = $('#table-row');
      var value = button.data('value');

      console.log('Data-value:', value);

      var modal = $('#stock-card');
      var modalValueElement = modal.find('#modal-value');

      if (modalValueElement.length) {
        modalValueElement.text(value);
      } else {
        console.error('Modal value element not found');
      }
    });
  });