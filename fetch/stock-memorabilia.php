<?php
include '../connection.php'; 

header('Content-Type: application/json');

$sql = "SELECT * FROM memorabilia_view ORDER BY `date` DESC"; 
$result = $conn->query($sql);

$rows = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $nameParts = explode(',', $row['name']);
        $firstName = trim($nameParts[0]);
        $middleName = isset($nameParts[1]) ? trim($nameParts[1]) : '';
        $lastName = isset($nameParts[2]) ? trim($nameParts[2]) : '';
        $suffix = isset($nameParts[3]) ? trim($nameParts[3]) : '';
        
        $middleInitial = !empty($middleName) ? strtoupper(substr($middleName, 0, 1)) . '.' : '';
        
        $name = $firstName . ' ' . $middleInitial . ' ' . $lastName;
        
        if (!empty($suffix)) {
            $name .= ' ' . $suffix;
        }

        $row['price'] = $row['price'] ? $row['price'] : 'to set' ;
        $row['cost'] = $row['cost'] ? $row['cost'] : 'to set' ;

        $row['status'] = $row['status'] ? 'Yes' : 'No'; 
        
        $row['name'] = trim($name); 

        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode([]);
}

$conn->close();
?>
