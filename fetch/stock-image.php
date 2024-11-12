<?php
header('Content-Type: application/json');
require '../connection.php'; 

$itemId = isset($_GET['id']) ? $_GET['id'] : 0;

if ($itemId > 0) {
    $query = "SELECT media FROM stock_details WHERE stock_no = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $itemId);
        $stmt->execute();
        $stmt->bind_result($media);
        $stmt->fetch();
        $stmt->close();

        $defaultImage = 'data:image/jpeg;base64,' . base64_encode(file_get_contents('../../src/img/no-image.jpg'));

        if ($media) {
            $mediaBase64 = base64_encode($media);
            echo json_encode(['success' => true, 'media' => 'data:image/jpeg;base64,' . $mediaBase64]);
        } else {
            echo json_encode(['success' => true, 'media' => $defaultImage]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database query error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid item ID.']);
}

$conn->close();
?>
