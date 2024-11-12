<?php
header('Content-Type: application/json');

include '../connection.php';

$sql = "SELECT identifier, program, course FROM program";
$result = $conn->query($sql);

$programs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $identifier = $row['identifier'];
        if (!isset($programs[$identifier])) {
            $programs[$identifier] = [
                'program' => $row['program'],
                'courses' => []
            ];
        }
        $programs[$identifier]['courses'][] = $row['course'];
    }
}

$conn->close();
echo json_encode(array_values($programs));
?>
