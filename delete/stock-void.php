<?php
include '../connection.php';  

session_start();

$data = json_decode(file_get_contents('php://input'), true);
$itemName = $data['itemName'];
$accId = $_SESSION['acc_id'];

if (!$itemName || !$accId) {
    echo json_encode(['error' => 'Item name and account ID are required']);
    exit;
}

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("CALL DeleteItem(?, ?)");

    $stmt->bind_param('ss', $itemName, $accId);  

    if ($stmt->execute()) {
        $conn->commit();
        echo json_encode(['success' => 'Item deleted successfully']);
    } else {
        $conn->rollback();
        echo json_encode(['error' => 'Failed to execute stored procedure']);
    }

    $stmt->close();
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['error' => 'Failed to delete item: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
