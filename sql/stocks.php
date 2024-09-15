<?php

// include 'connection.php';

$ss_result = $conn->query("SELECT * FROM stock_details");

$cat_result = $conn->query("SELECT DISTINCT category FROM inventory");


?>
