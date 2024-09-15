<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 

$udata_sql = "SELECT * FROM user_data WHERE account_id = '{$_SESSION['acc_id']}'";
$uds_result = $conn->query($udata_sql);

if($uds_result->num_rows > 0){
    $ud = $uds_result->fetch_assoc();

    switch($ud['role']){
        case 0:
            $role = 'System Admin';
            break;
        case 1:
            $role = 'RGO Staff';
            !isset($_SESSION['actor']) ? $actor = 1 : $_SESSION['actor'];
            break;
        case 2:
            $role = 'Student';
            !isset($_SESSION['actor']) ? $actor = 2 : $_SESSION['actor'];
            break;
        case 3:
            $role = 'Facilitator';
            !isset($_SESSION['actor']) ? $actor = 2 : $_SESSION['actor'];
            break;
        default:
            $role = 'Guest';
            !isset($_SESSION['actor']) ? $actor = 2 : $_SESSION['actor'];
            break;
    }

    $nameParts = explode(' ', $ud['name']);
    $fName = explode(',', $ud['name']);
    $firstName = $fName[0];
    $lastName = $nameParts[count($nameParts) - 1];

    $name = $firstName . ' ' . $lastName;
    $profile = $ud['cover'] == 1 ? 'data:image/jpeg;base64,' . base64_encode($ud['media']) : 'img/default-user.png'; 
    $username = $ud['username'];
}else{
    echo 'error fetching user data';
}

?>