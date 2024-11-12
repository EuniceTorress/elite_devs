
<div class="row" id="all-container">

    <div class="table-responsive">
        <?php if($type == 'log') { 
            include '../logs.php';
        }
        switch ($typeNum){
            case 1:
                if (strpos($type, 'stocks') !== false){
                    include '../../src/css/pages/stocks/list.php';
                    include '../stocks/list.php';
                }else if (strpos($type, 'sales') !== false){
                    include '../../src/css/pages/sales/entry.php';
                    include '../sales/entry.php';
                }else if (strpos($type, 'news') !== false){
                    include '../../src/css/pages/feeds/feeds.php';
                    include '../feeds/create-post.php';
                }else if (strpos($type, 'facilities') !== false){
                    include '../../src/css/pages/facilities/facility.php';
                    include '../facilities/facility.php';
                }
                break;
            case 2:
                if (strpos($type, 'stocks') !== false){
                    if($actor == 1){
                        include '../../src/css/pages/stocks/memorabilia.php';
                        include '../stocks/memorabilia.php';
                    }
                }else if (strpos($type, 'sales') !== false){
                    include '../sales/record.php';
                }else if (strpos($type, 'news') !== false){
                    include '../../src/css/pages/feeds/feeds.php';
                    include '../feeds/news-feed.php';
                }else if (strpos($type, 'facilities') !== false){
                    include '../../src/css/pages/facilities/expenses.php';
                    include '../facilities/expenses.php';
                }
                break;
            case 3:
                if (strpos($type, 'stocks') !== false){
                        include '../../src/css/pages/stocks/inventory.php';
                        include '../stocks/inventory.php';
                }else if (strpos($type, 'facilities') !== false){
                    if ($actor == 1){
                        include '../facilities/rentals.php';
                    }else {
                        include '../../src/css/pages/facilities/c-rentals.php';
                        include '../facilities/c-rentals.php';
                    }
                }
                break;
            case 4:
                if (strpos($type, 'stocks') !== false){
                    include '../../src/css/pages/stocks/cart.php';
                    include '../stocks/c-cart.php';
                }
                break;
            case 5:
                if (strpos($type, 'stocks') !== false){
                    if($actor == 1){
                        include '../stocks/reservation.php';
                        include '../../src/css/pages/stocks/reservation.php';
                    }else {
                        include '../../src/css/pages/stocks/list.php';
                        include '../../src/css/pages/stocks/c-reservation.php';
                        include '../stocks/c-reservation.php';
                    }
                }
                break;
            default: 
                break;
        }
        ?>
    </div>
</div>
