<?php

include 'connection.php';

$stocks_sql = "SELECT * FROM stock_details";
$ss_result = $conn->query($stocks_sql);

$category_sql = "SELECT DISTINCT category FROM stocks";
$cat_result = $conn->query($category_sql);
?>
