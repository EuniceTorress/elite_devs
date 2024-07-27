<?php
session_start();
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
include '../sql/user-panel.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'tockpile</title>
    <link rel="icon" href="img/rgo.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/scrollbar.css">

    <style>

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #e3e3e3;
            overflow-x: hidden;
        }

        .main-content {
            background-color: #DFD3C3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: calc(100% - 40px);
            margin: 20px auto;
            border: 1px solid rgba(128,0,0,0.5);
            box-sizing: border-box;
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
                case 'reservations':
                    include 'pages/reservations.php';
                    break;
                case strpos($type, 'sales') !== false:
                    if (strpos($type, 'entry') !== false) {
                        include 'pages/data.php';
                    } else {
                        include 'pages/records.php';
                    }
                    break;
                case 'stocks':
                    include 'pages/stocks.php';
                    break;
                default:
                    include 'pages/dashboard.php';
                    break;
            }
            ?>
    </div>

    <script src="js/address.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
