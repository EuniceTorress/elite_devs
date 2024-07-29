<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
?>

<style>

    .nav-link {
        cursor: pointer;
        color: black;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: bold;
    }

    .nav-link:first-child {
        border-radius: 20px 0 0 0;
    }

    .nav-link:hover {
        color: white;
        background-color: maroon;
        border-radius: 20px 20px 0 0;
    }

    .nav-link.active {
        background-color: rgba(255, 0, 0, 0.3);
        border-radius: 20px 20px 0 0;
    }

    .nav-link:first-child.active {
        border-left: 1px solid maroon;
    }

    .nav-link:first-child:hover {
        border-left: 1px solid maroon;
    }

    .nav-link:last-child:hover,
    .nav-link:last-child.active {
        border-right: 1px solid maroon;
    }

    .data-header{
        margin-top: 20px;
        margin-left: 20px;
    }

    .data {
        margin-top: 0px;
    }


</style>
    <div class="data-header row">
        <a href="user-homepage.php?type=sales-entry1" class="nav-link <?= strpos($type, '1') !== false ? 'active' : '' ?>">Facility Rental</a>
        <a href="user-homepage.php?type=sales-entry2" class="nav-link <?= strpos($type, '2') !== false ? 'active' : '' ?>">Merchandise</a>
    </div>
    <div class="main-content data">
        <!-- rentals -->
        <?php
        if(strpos($type, '1') !== false){
            include 'data-entry/rentals.php';
        }else {
            include 'data-entry/reservations.php';
        }
        ?>

        <!-- reservations -->
    </div>