<?php
include '../connection.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 2;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$sql = "SELECT id, title, content, `date`
        FROM feeds 
        WHERE active = 1 
        ORDER BY `date` DESC 
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    $post_id = $row['id'];
    $img_stmt = $conn->prepare("SELECT media FROM media WHERE foreign_table = ?");
    $img_stmt->bind_param("s", $post_id);
    $img_stmt->execute();
    $img_result = $img_stmt->get_result();
    
    $images = [];
    while ($img_row = $img_result->fetch_assoc()) {
        $images[] = 'data:image/jpeg;base64,' . base64_encode($img_row['media']); 
    }

    $row['images'] = $images;
    $posts[] = $row;
    $img_stmt->close();
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'posts' => $posts]);
?>
