<?php
session_start();
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "?") + 1); 
$typeNum = substr($type, strpos($type, "-") + 1); 

date_default_timezone_set('Asia/Manila');

$currentDate = date('Y-m-d'); 
$currentTime = date('H:i:s');

if (!isset($_SESSION['acc_id'])){
    header("Location: ../../index.php");
    exit();
}else {

$actor = $_SESSION['actor'];

include 'header.php';

?>

<body>
    <div class="container-fluid" id="main-body">
        <?php
        include 'sidebar.php';
        ?>
        <div class="main-content">
            <?php
            include 'navbar.php';
            ?>
            <div class="content">
                <?php

                if(strpos($type, 'dashboard') !== false){
                    if($actor == 0){
                        include '../dashboard/sysadmin.php';
                    } elseif ($actor == 1){
                        include '../dashboard/rgostaff.php';
                    } else {
                        include '../../src/css/pages/feeds/feeds.php';
                        if($actor == 2){
                            include '../feeds/home.php';
                            include '../feeds/merch.php';
                        }
                        include '../feeds/news-feed.php';
                    }
                }else {
                    include 'panel.php';
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php
include 'footer.php';
}
?>
