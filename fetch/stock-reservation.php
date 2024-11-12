<?php
include '../connection.php';

session_start();

$sql = "SELECT * FROM reservation";
$result = $conn->query($sql);

$reservations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $detailsArray = json_decode($row['details'], true);
        
        if (!$detailsArray) { 
            $details = explode(',', $row['details']);
            $detailsArray = [
                [
                    'id' => trim($details[0]),
                    'item_name' => trim($details[1]),
                    'description' => trim($details[2]),
                    'quantity' => trim($details[3]),
                    'price' => trim($details[4]),
                ]
            ];
        }

        switch ($row['role']) {
            case 0:
                $row['role'] = 'System Admin';
                break;
            case 1:
                $row['role'] = 'RGO Staff';
                break;
            case 2:
                $row['role'] = 'Student';
                break;
            case 3:
                $row['role'] = 'Facilitator';
                break;
            default:
                $row['role'] = 'Unknown'; 
                break;
        }

        if ($row['profile']) {
            $row['profile'] = base64_encode($row['profile']);
        }else {
            $row['profile'] = '../../src/img/user.png';
        }

        $nameParts = explode(',', $row['name']);
        $firstName = trim($nameParts[0]);
        $middleInitial = isset($nameParts[1]) ? strtoupper(substr(trim($nameParts[1]), 0, 1)) . '.' : '';
        $lastName = isset($nameParts[2]) ? trim($nameParts[2]) : '';

        $name = $firstName . ' ' . $middleInitial . ' ' . $lastName;

        $row['name'] = $name;  
        $row['details'] = $detailsArray;
        $reservations[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($reservations);
?>
