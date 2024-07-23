<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
?>

<style>

    .card-header {
        border: 0px;
        background: none;
        margin-left: 0px;
    }

    .card-header .nav-link {
        cursor: pointer;
        color: black;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: bold;
    }

    .card-header .nav-link:first-child {
        border-radius: 20px 0px 0px 0px;
    }

    .card-header .nav-link:hover {
        color: white;
        background-color: maroon;
        border-radius: 20px 20px 0px 0px;
    }

    .card-header .nav-link.active {
        background-color: rgba(255,0,0,0.3);
        border-radius: 20px 20px 0px 0px;
    }

    .card-header .nav-link:first-child.active {
        background-color: rgba(255,0,0,0.3);
        border-radius: 20px 20px 0px 0px;
        border-left: 1px solid maroon;
    }
    
    .card-header .nav-link:first-child:hover {
        border-radius: 20px 20px 0px 0px;
        border-left: 1px solid maroon;
    }

    .card-header .nav-link:last-child:hover,
    .card-header .nav-link:last-child.active {
        border-right: 1px solid maroon;
    }

    .data {
        margin-top: -12px;
        border-radius: 0px 10px 10px 10px;
    }
</style>

<div class="card card-container">
    <div class="card-header row">
        <a href="user-homepage.php?type=sales-entry1" class="nav-link <?= strpos($type, '1') !== false ? 'active' : '' ?>">Facility Rental</a>
        <a href="user-homepage.php?type=sales-entry2" class="nav-link <?= strpos($type, '2') !== false ? 'active' : '' ?>">Merchandise</a>
    </div>
    <div class="main-content data">
        <!-- rentals -->
        <?php
        if(strpos($type, '2') !== false){
            include 'data-entry/reservations.php';
        }else {
            include 'data-entry/rentals.php';
        }
        ?>
        <!-- reservations -->
    </div>
</div>
<script>

</script>