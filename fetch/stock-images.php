<?php
require_once '../connection.php';

$sql = "SELECT id, media FROM media WHERE foreign_table = 'stocks' AND cover = 0 ORDER BY date DESC";
$result = $conn->query($sql);

$images = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageData = base64_encode($row['media']);  
        $imageSrc = 'data:image/jpeg;base64,' . $imageData; 
        $images[] = [
            'id' => $row['id'], 
            'src' => $imageSrc
        ];
    }
}

$conn->close();

echo json_encode($images);
?>
