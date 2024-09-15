<?php
session_start();
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
include '../sql/connection.php';
include '../sql/user-panel.php'; 

date_default_timezone_set('Asia/Manila');

$currentDate = date('Y-m-d'); 
$currentTime = date('H:i:s');

if (!isset($_SESSION['acc_id'])){
    header("Location: ../forms.php?type=form-login");
    exit();
}else {

$actor = $_SESSION['actor'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'tockpile</title>
    <link rel="icon" href="<?php echo $logo; ?>" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.2/main.min.css">
    <link rel="stylesheet" href="css/scrollbar.css">

    <style>

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: white;
            overflow-x: hidden;
        }

        @media (min-width: 768px) {
            .main-content {
                width: calc(100% - 40px); 
                max-width: 1500px; 
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container-fluid p-0">
            <?php
            include 'sidebar.php';

            switch($type) {
                case 'logs':
                    include 'pages/logs.php';
                    break;
                case 'news':
                    include 'pages/news.php';
                    break;
                case strpos($type, 'facilities') !== false:
                    include 'pages/facility.php';
                    break;
                case strpos($type, 'reservations') !== false:
                    if (strpos($type, 'facility') !== false) {
                        include 'pages/reservations/facility.php';
                    } else {
                        include 'pages/reservations/stocks.php';
                    }
                    break;
                case strpos($type, 'sales') !== false:
                        include 'pages/sales/data.php';
                    break;
                case strpos($type, 'stocks') !== false:
                    include 'pages/stocks/pannel.php';
                    break;
                case strpos($type, 'cart') !== false:
                    include 'pages/stocks/cart.php';
                    break;
                default:
                    if($actor == 0){
                        include 'pages/logs.php';
                    } elseif ($actor == 1){
                        include 'pages/dashboard.php';
                    } else {
                        include 'pages/stocks/pannel.php';
                    }
                    break;
            }
            ?>
    </div>

    <script src="js/date-time.js"></script>
    <script src="js/stocks-suggestions.js"></script>
    <script src="js/address.js"></script>
    <script src="js/message.js"></script>
    <script src="js/search.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.2/main.min.js"></script>
</body>
</html>
<?php } ?>
