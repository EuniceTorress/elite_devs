<?php
require_once '../connection.php';

session_start();
$acc_id = $_SESSION['acc_id'];

$stock_id = isset($_POST['stock_id']) ? $_POST['stock_id'] : 0;

$sql = "CALL deleteStockMedia(?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $stock_id, $acc_id);

    if (mysqli_stmt_execute($stmt)) {
        $response = [
            'success' => true,
            'message' => 'Media deleted successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error deleting media: ' . mysqli_stmt_error($stmt)
        ];
    }

    mysqli_stmt_close($stmt);
} else {
    $response = [
        'success' => false,
        'message' => 'Error preparing statement: ' . mysqli_error($conn)
    ];
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($response);
?>
