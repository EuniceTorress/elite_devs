<?php

include 'connection.php';

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
            break;
        case 2:
            $role = 'Student';
            break;
        case 3:
            $role = 'Facilitator';
        default:
            $role = 'Guest';
    }

    $nameParts = explode(' ', $ud['name']);
    $fName = explode(',', $ud['name']);
    $firstName = $fName[0];
    $lastNameInitial = substr($nameParts[count($nameParts) - 1], 0, 1) . '.';

    $name = $firstName . ' ' . $lastNameInitial;
    $profile = $ud['cover'] == 1 ? 'data:image/jpeg;base64,' . base64_encode($ud['media']) : 'img/default-user.png'; 
    $username = $ud['username'];
}else{
    echo 'error fetching user data';
}

?>