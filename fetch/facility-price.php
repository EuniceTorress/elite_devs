<?php
$facility_prices = [
    'Room 1' => 100,
    'Room 2' => 200,
];

$manpower_prices = [
    'Room 1' => 50,
    'Room 2' => 75,
];

if (isset($_GET['facility'])) {
    $facility = $_GET['facility'];
    echo json_encode(['price' => $facility_prices[$facility]]);
}

if (isset($_GET['manpower'])) {
    $manpower = $_GET['manpower'];
    echo json_encode(['price' => $manpower_prices[$manpower]]);
}
?>
