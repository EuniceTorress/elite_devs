<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../sql/connection.php';
    ?>
    <link rel="icon" href="<?php echo $logo; ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "?") + 1); 
include '../src/css/index/form.php';
?>
<body>
<div id="log" class="p-2">
    <div class="container for-bg">
        <div class="row">
            <div class="<?php echo ($type != 3) ? 'col-lg-6' : ''; ?>">
            <div class="login">
                <div class="home p-2">
                    <a type="button" href=<?php
                            if ($type != 3) {
                                echo '../index.php';
                            } else {
                                echo 'forms.php?2';
                            }
                        ?> id="home-btn">
                    <span class="material-icons">
                        <?php
                            if ($type != 3) {
                                echo 'home';
                            } else {
                                echo 'arrow_back';
                            }
                        ?>
                    </span>
                    </a>
                </div>
    <?php

    switch($type){
        case 1:
            include 'login.php';
            break;
        case 2:
            include 'sign-up.php';
            break;
        case 3:
            include 'user-info.php';
            break;
        default:
            break;
    }

    ?>
        </div>
        </div>
            <?php if($type != 3){ ?>
            <div class="col-lg-6 p-0">
                <div class="image-container">
                    <div class="text-overlay d-flex justify-content-start align-items-end">
                        Welcome to Resource <br>Generation Office<br> Website !
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>