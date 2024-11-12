<?php
require_once '../connection.php';

session_start();

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageId = isset($_POST['image_id']) ? $_POST['image_id'] : 0;

    if ($imageId > 0) {
        $sql = "DELETE FROM media WHERE id = ?"; 

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $imageId);

            if ($stmt->execute()) {
                $logStmt = $conn->prepare("INSERT INTO logs (id, acc_id, action, description, table_name, date) 
                                           VALUES (UUID(), ?, 'delete', ?, 'media', NOW())");
                $acc_id = $_SESSION['acc_id']; 
                $description = "Deleted image with ID: $imageId";

                $logStmt->bind_param("ss", $acc_id, $description);

                if ($logStmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Image deleted and log inserted successfully.';
                } else {
                    $response['message'] = 'Error inserting log: ' . $logStmt->error;
                }

                $logStmt->close();
            } else {
                $response['message'] = 'Error executing query.';
            }

            $stmt->close();
        } else {
            $response['message'] = 'Error preparing statement.';
        }
    } else {
        $response['message'] = 'Invalid image ID.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
