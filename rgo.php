<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .sales-c {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        height: 500px;
    }

    .inv-c {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        height: 650px;
        margin: 20px 0;
    }
</style>

<?php
include 'rgo/kpi.php';
echo '<div class="sales-c">';
    include 'rgo/sales.php';
    include 'rgo/sold.php';
echo '</div>';
    include 'rgo/comp.php';
echo '<div class="inv-c">';
    include 'rgo/stacked.php';
    include 'rgo/total-s.php';
    include 'rgo/pie-c.php';
echo '</div>';


?>

<script>
    window.onload = function() {

        loadSales();
        loadSold();
        loadStocks();
        loadSoldByCategory();
    }

    function formatNumber(value) {
        return value.toLocaleString(); 
    }


    document.getElementById('month').addEventListener('change', function() {
        const selectedMonth = this.value;
        const selectedYear = document.getElementById('year').value;
        fetchSalesData(selectedMonth, selectedYear);
        fetchTopItems(selectedMonth, selectedYear);
        loadStockAndSales("", selectedMonth, selectedYear);
        fetchAnalyticsData(selectedMonth, selectedYear);
    });

    document.getElementById('year').addEventListener('change', function() {
        const selectedYear = this.value;
        const selectedMonth = document.getElementById('month').value;
        fetchSalesData(selectedMonth, selectedYear);
        fetchAnalyticsData(selectedMonth, selectedYear);
        loadStockAndSales("", selectedMonth, selectedYear);
        fetchTopItems(selectedMonth, selectedYear);
    });

</script>