<?php

include '../connection.php';

$response = [
    'success' => false,
    'message' => 'An unexpected error occurred during the process.'
];

$stmt = $conn->prepare("CALL InsertOrUpdateStock(?, ?, ?, ?, ?, @stock_no)");

if ($stmt === false) {
    $response['message'] = "An error occurred while preparing the statement: " . $conn->error;
    echo json_encode($response);
    exit;
}

$itemsInserted = 0;

foreach ($_POST as $key => $value) {
    if (strpos($key, 'itemName') === 0) {
        $index = str_replace('itemName', '', $key);

        $itemName = isset($_POST["itemName" . $index]) ? htmlspecialchars(ucwords($_POST["itemName" . $index])) : '';
        $description = isset($_POST["itemDescription" . $index]) ? htmlspecialchars($_POST["itemDescription" . $index]) : '';
        $category = isset($_POST["itemCategory" . $index]) ? htmlspecialchars($_POST["itemCategory" . $index]) : '';
        $otherCategory = isset($_POST["otherCategory" . $index]) ? htmlspecialchars($_POST["otherCategory" . $index]) : '';
        $quantity = isset($_POST["itemQuantity" . $index]) ? intval($_POST["itemQuantity" . $index]) : 0;
        $unitPrice = isset($_POST["itemPrice" . $index]) ? floatval($_POST["itemPrice" . $index]) : 0.00;
        $unitCost = isset($_POST["itemCost" . $index]) ? floatval($_POST["itemCost" . $index]) : 0.00;

        if (!empty($otherCategory)) {
            $category = $otherCategory;
        }

        if ($description != '') {
            $itemName .= ', ' . $description;
        }

        $stmt->bind_param("ssddd", $category, $itemName, $quantity, $unitCost, $unitPrice);
        if (!$stmt->execute()) {
            $response['message'] = "An error occurred while executing the statement: " . $stmt->error;
            echo json_encode($response);
            exit;
        }

        $result = $conn->query("SELECT @stock_no AS stock_no");
        if ($result === false) {
            $response['message'] = "An error occurred while fetching the stock number: " . $conn->error;
            echo json_encode($response);
            exit;
        }

        $row = $result->fetch_assoc();
        $new_stock_no = $row['stock_no'];

        $itemsInserted++;
    }
}

$stmt->close();

$response['success'] = true;
$response['message'] = "Stock details were successfully processed, item(s) inserted: $itemsInserted";
echo json_encode($response);
?>
