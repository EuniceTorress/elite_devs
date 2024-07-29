<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "stockpile";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$logo_sql = "SELECT media FROM media WHERE foreign_table = 'logo' AND cover = 1";
$ls_result = $conn->query($logo_sql);

if($ls_result->num_rows > 0){
    $ls = $ls_result->fetch_assoc();
    $logo = 'data:image/jpeg;base64,' . base64_encode($ls['media']);
}
else {
    echo 'error fetching logo';
}

?>