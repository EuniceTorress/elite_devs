document.addEventListener('DOMContentLoaded', function() {
    const printReportButton = document.getElementById('printReport');

    if (printReportButton) {
        printReportButton.addEventListener('click', function(event) {
            event.preventDefault(); 
            window.print(); 
        });
    }
});