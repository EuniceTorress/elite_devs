<?php
include 'connection.php';

$program_course_sql = $conn->query("SELECT `identifier`, `program`, `course` FROM program");

$data = [];

while ($row = $program_course_sql->fetch_assoc()) {
    $identifier = $row['identifier'];
    
    if (!isset($data[$identifier])) {
        $data[$identifier] = [
            'program' => $row['program'],
            'courses' => []               
        ];
    }
    
    $data[$identifier]['courses'][] = $row['course'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
