<?php
$host = 'localhost'; // Adjust these settings based on your setup
$dbname = 'your_db_name';
$username = 'your_username';
$password = 'your_password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_GET['type'] === 'facility') {
        $stmt = $conn->query("SELECT id, facility_name FROM facilities");
        $facilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($facilities);
    }

    if ($_GET['type'] === 'manpower') {
        $stmt = $conn->query("SELECT id, manpower_name FROM manpower");
        $manpower = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($manpower);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
