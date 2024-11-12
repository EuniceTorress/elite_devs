<div id="print-modal">
  <div class="modal-content">
    <span id="close-modal" class="close">&times;</span>
    <h2>Select Report to Print</h2>

    <div class="report-container">
      <div class="report-type col-6">
        <label>
          <input type="radio" name="reportType" value="merchandiseReleased" checked>
          Merchandise Released
        </label>
        <label>
          <input type="radio" name="reportType" value="inventory">
          Inventory
        </label>
      </div>

      <div id="date-picker-container">
        <input type="text" id="date-picker" class="datepicker" placeholder="Select Date">
      </div>
    </div>

    <button id="confirm-print">Print</button>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
  #print-modal {
    opacity: 0;
    visibility: hidden;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000;
    transition: opacity 0.4s ease, visibility 0.4s ease;
  }

  #print-modal .modal-content {
    background-color: #fff;
    padding: 25px;
    border-radius: 12px;
    max-width: 420px;
    width: 90%;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    position: relative;
    font-family: Arial, sans-serif;
  }

  #print-modal.show {
    opacity: 1;
    visibility: visible;
  }

  #close-modal {
    position: absolute;
    top: 10px;
    right: 15px;
    background-color: transparent;
    outline: none;
    border: none;
    padding: 5px 10px;
    font-size: 1.3rem;
    color: #1c1e21; 
    cursor: pointer;
  }

  #print-modal h2 {
    font-size: 24px;
    color: #333;
    margin: 0 0 20px;
    font-weight: 600;
    text-align: center;
  }

  .report-container {
    display: flex;
    gap: 20px;
  }

  .report-type {
    display: flex;
    flex-direction: column;
    font-size: 16px;
  }

  .report-type label {
    margin-bottom: 10px;
    cursor: pointer;
  }

  #date-picker-container {
    display: flex;
    align-items: center;
    flex-grow: 1;
  }

  .datepicker {
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    width: 100%;
    box-sizing: border-box;
  }

  #confirm-print {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  #confirm-print:hover {
    background-color: #2980b9;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const printButton = document.getElementById("printReport");
    const printModal = document.getElementById("print-modal");
    const closeButton = document.getElementById("close-modal");
    const confirmPrintButton = document.getElementById("confirm-print");

    const reportTypeRadios = document.querySelectorAll("input[name='reportType']");
    const datePicker = document.getElementById("date-picker");

    function initializeDatePicker() {
      const selectedReportType = document.querySelector("input[name='reportType']:checked").value;
      datePicker._flatpickr && datePicker._flatpickr.destroy(); 
      flatpickr(datePicker, {
        dateFormat: selectedReportType === "merchandiseReleased" ? "Y-m-d" : "Y-m",
        defaultDate: "today",
      });
    }

    printButton.addEventListener("click", function() {
      printModal.classList.add("show");
    });

    closeButton.addEventListener("click", function() {
      printModal.classList.remove("show");
    });

    confirmPrintButton.addEventListener("click", function() {
    const selectedReportType = document.querySelector("input[name='reportType']:checked").value;
    const selectedDate = datePicker.value;

    const reportUrl = `../../sql/reports/generate-report.php?reportType=${encodeURIComponent(selectedReportType)}&date=${encodeURIComponent(selectedDate)}`;
    
    fetch(reportUrl)
      .then(response => response.text())
      .then(reportContent => {
        const printWindow = window.open('', '', 'width=1000,height=1000');
        printWindow.document.write(reportContent);
        printWindow.document.close();
        
        printWindow.onload = function() {
          printWindow.print();
          printWindow.close();
        };
      })
      .catch(error => {
        console.error("Error fetching report:", error);
      });
});


    reportTypeRadios.forEach(function(radio) {
      radio.addEventListener("change", initializeDatePicker);
    });

    initializeDatePicker();
  });
</script>
