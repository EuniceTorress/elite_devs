<?php
include '../connection.php';

$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

$response = [
    'inventoryTurnover' => 0,
    'occupancyRate' => 0,
    'reservationFulfillment' => 0,
    'stockAvailability' => 0,
    'error' => null
];

$inventoryTurnoverQuery = "SELECT DISTINCT
(SELECT SUM(qty) FROM order_list) AS totalSales,
(SELECT SUM(qty) FROM inventory) AS totalStock
FROM inventory
INNER JOIN order_list ON inventory.stock_no = order_list.stock_no";
if ($year) {
    $inventoryTurnoverQuery .= $month ? " WHERE MONTH(date) = ? AND YEAR(date) = ?" : " WHERE YEAR(date) = ?";
}

$inventoryTurnoverStmt = $conn->prepare($inventoryTurnoverQuery);
if ($month && $year) {
    $inventoryTurnoverStmt->bind_param('ii', $month, $year);
} elseif ($year) {
    $inventoryTurnoverStmt->bind_param('i', $year);
}
$inventoryTurnoverStmt->execute();
$inventoryTurnoverResult = $inventoryTurnoverStmt->get_result();

if ($inventoryTurnoverResult->num_rows > 0) {
    $row = $inventoryTurnoverResult->fetch_assoc();
    $totalSales = $row['totalSales'];
    $totalStock = $row['totalStock'];
    $response['inventoryTurnover'] = ($totalStock > 0) ? ($totalSales / $totalStock) * 100 : 0;
} else {
    $response['inventoryTurnover'] = 0;
}

$occupancyRateQuery = "SELECT COUNT(*) AS totalBookings,
                        (SELECT COUNT(DISTINCT foreign_id) 
                         FROM rental_details 
                         INNER JOIN rentals ON rental_details.rental_id = rentals.id
                         WHERE type = 'facility' AND `status` = 2) AS totalFacilities
                        FROM rental_details";
if ($year) {
    $occupancyRateQuery .= $month ? " WHERE MONTH(dateAdded) = ? AND YEAR(dateAdded) = ?" : " WHERE YEAR(dateAdded) = ?";
}

$occupancyRateStmt = $conn->prepare($occupancyRateQuery);
if ($month && $year) {
    $occupancyRateStmt->bind_param('ii', $month, $year);
} elseif ($year) {
    $occupancyRateStmt->bind_param('i', $year);
}
$occupancyRateStmt->execute();
$occupancyRateResult = $occupancyRateStmt->get_result();

if ($occupancyRateResult->num_rows > 0) {
    $row = $occupancyRateResult->fetch_assoc();
    $totalBookings = $row['totalBookings'];
    $totalFacilities = $row['totalFacilities'];
    $response['occupancyRate'] = ($totalFacilities > 0) ? ($totalBookings / $totalFacilities) * 100 : 0;
} else {
    $response['occupancyRate'] = 0;
}

$reservationFulfillmentQuery = "SELECT COUNT(DISTINCT rental_details.foreign_id) AS fulfilledReservations
                                FROM rental_details
                                INNER JOIN rentals ON rental_details.rental_id = rentals.id
                                WHERE rental_details.type = 'facility' 
                                AND rentals.status = 4";
if ($year) {
    $reservationFulfillmentQuery .= $month ? " AND MONTH(date_modified) = ? AND YEAR(date_modified) = ?" : " AND YEAR(date_modified) = ?";
}

$reservationFulfillmentStmt = $conn->prepare($reservationFulfillmentQuery);
if ($month && $year) {
    $reservationFulfillmentStmt->bind_param('ii', $month, $year);
} elseif ($year) {
    $reservationFulfillmentStmt->bind_param('i', $year);
}
$reservationFulfillmentStmt->execute();
$reservationFulfillmentResult = $reservationFulfillmentStmt->get_result();

if ($reservationFulfillmentResult->num_rows > 0) {
    $row = $reservationFulfillmentResult->fetch_assoc();
    $fulfilledReservations = $row['fulfilledReservations'];
    $response['reservationFulfillment'] = ($totalBookings > 0) ? ($fulfilledReservations / $totalBookings) * 100 : 0;
} else {
    $response['reservationFulfillment'] = 0;
}

$stockAvailabilityQuery = "SELECT i.stock_no,
                            (SUM(i.qty) - COALESCE(SUM(ol.qty), 0)) AS availableStock
                            FROM inventory i
                            LEFT JOIN order_list ol ON i.stock_no = ol.stock_no AND ol.type = 'sales'";
if ($year) {
    $stockAvailabilityQuery .= $month ? " WHERE MONTH(date) = ? AND YEAR(date) = ? GROUP BY i.stock_no" : " WHERE YEAR(date) = ? GROUP BY i.stock_no";
}

$stockAvailabilityStmt = $conn->prepare($stockAvailabilityQuery);
if ($month && $year) {
    $stockAvailabilityStmt->bind_param('ii', $month, $year);
} elseif ($year) {
    $stockAvailabilityStmt->bind_param('i', $year);
}
$stockAvailabilityStmt->execute();
$stockAvailabilityResult = $stockAvailabilityStmt->get_result();

if ($stockAvailabilityResult->num_rows > 0) {
    $row = $stockAvailabilityResult->fetch_assoc();
    $availableStock = $row['availableStock'];
    
    $totalStockQuery = "SELECT DISTINCT ((SELECT SUM(qty) FROM inventory) - (SELECT SUM(qty) FROM order_list)) AS totalStock
    FROM inventory i
    LEFT JOIN order_list ol ON i.stock_no = ol.stock_no AND ol.type = 'sales'";
    if ($year) {
        $totalStockQuery .= $month ? " WHERE MONTH(i.date) = ? AND MONTH(ol.timestamp) = ? AND YEAR(date) = ? AND YEAR(ol.timestamp) = ?" 
                                   : " WHERE YEAR(i.date) = ? AND YEAR(ol.timestamp) = ?";
    }
    $totalStockStmt = $conn->prepare($totalStockQuery);
    if ($month && $year) {
        $totalStockStmt->bind_param('iiii', $month, $month, $year, $year);
    } elseif ($year) {
        $totalStockStmt->bind_param('ii', $year, $year);
    }
    $totalStockStmt->execute();
    $totalStockResult = $totalStockStmt->get_result();
    
    if ($totalStockResult->num_rows > 0) {
        $totalStockRow = $totalStockResult->fetch_assoc();
        $totalStock = $totalStockRow['totalStock'];
        $response['stockAvailability'] = ($totalStock > 0) ? ($availableStock / $totalStock) * 100 : 0;
    } else {
        $response['stockAvailability'] = 0;
    }
} else {
    $response['stockAvailability'] = 0;
}

echo json_encode($response);
$conn->close();
?>
