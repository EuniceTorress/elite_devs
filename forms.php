<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
    color: #333;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #ffffff, #dddddd);
}

.form-box {
    padding: 30px;
    border-radius: 12px;
    background-color: #ffffff;
    color: #333;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    min-width: 30%;
    width: 80%;
}

.form-box h1 {
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    border-bottom: 2px solid #800000;
    padding-bottom: 10px;
}

.input-group input {
    padding: 12px;
    border: 0.5px solid rgba(128, 5, 5, 0.4);
    border-radius: 10px;
    background-color: #f9f9f9;
    color: #333;
    font-size: 0.8rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 90%;
}

.input-group input::placeholder {
    opacity: 0.4;
    color: #800000;
}

.input-group input:focus {
    outline: none;
    border-color: #800000;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.3);
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    font-weight: 600;
    margin-bottom: 8px;
}

button {
    width: 95%;
    padding: 10px;
    border: none;
    margin-top: 20px;
    background-color: #800000;
    color: #fff;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
}

button:hover {
    background-color: #1f1f1f;
}

button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

.home-icon {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 1.5rem;
    color: #333;
}

.home-icon:hover {
    transform: scale(1.1);
    color: maroon;
}

h2 {
    margin-top: 0;
}
</style>
</head>
<body>
    <a href="index.php" class="home-icon">
        <i class="fas fa-home"></i>
    </a>
    <div class="container">
        <?php
            switch($type){
                case strpos($type, '1') !== false:
                    include 'email-validation.php';
                    break;
                case strpos($type, '2') !== false:
                    include 'user-info.php';
                    break;
                default:
                    include 'login.php';
                    break;
            }
        ?>
    </div>
</body>
</html>
