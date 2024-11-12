<div class="nav-panel">
    <ol class="breadcrumb">
        <?php
        if( $type == 'dashboard' && $actor == 1){
        ?>
            <section class="filter">
                <label for="month">Month:</label>
                <select id="month">
                    <option value="">All</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <label for="year">Year:</label>
                <select id="year">
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
            </section>
        <?php
        } else {
        ?>
        <li><a href="../body/body.php?stocks-0">
            <?php
                switch ($type){
                    case strpos($type, 'stocks') !== false:
                        echo 'Stocks';
                        break;
                    case strpos($type, 'facilities') !== false:
                        echo 'Facilities';
                        break;
                    case strpos($type, 'sales') !== false:
                        echo 'Sales';
                        break;
                    default:
                        echo '';
                        break;
                }
            ?>
        </a></li>
        <?php if($typeNum != 0) { ?>
        <li>
            <?php
            if($typeNum == 1){
                switch ($type){
                    case strpos($type, 'stocks') !== false:
                        echo '/ Merchandise';
                        break;
                    case strpos($type, 'facilities') !== false:
                        echo '/ Facility';
                        break;
                    case strpos($type, 'sales') !== false:
                        echo '/ Entry';
                        break;
                    default:
                        echo '';
                        break;
                }
            } else if ($typeNum == 2){
                switch ($type){
                    case strpos($type, 'facilities') !== false:
                        echo '/ Expenses';
                        break;
                    case strpos($type, 'sales') !== false:
                        echo '/ Record';
                        break;
                    case strpos($type, 'stocks') !== false:
                        echo '/ Memorabilia';
                        break;
                    default:
                        echo '';
                        break;
                }
            } else if ($typeNum == 3){
                switch ($type){
                    case strpos($type, 'stocks') !== false:
                        echo '/ Inventory';
                        break;
                    case strpos($type, 'facilities') !== false:
                        echo '/ Rentals';
                        break;
                    default:
                        echo '';
                        break;
                }
            } else if ($typeNum == 4){
                switch ($type){
                    case strpos($type, 'stocks') !== false:
                        echo '/ Cart';
                        break;
                    default:
                        echo '';
                        break;
                }
            } else if ($typeNum == 5){
                switch ($type){
                    case strpos($type, 'stocks') !== false:
                        echo '/ Reservation';
                        break;
                    default:
                        echo '';
                        break;
                }
            }
            ?>
        </li>
        <?php }
        } ?>
    </ol>
</div>

<?php
if ($actor != 0 ){
    if($actor == 2 || $type == 'dashboard' || $type == 'stocks-1') {
        if($type == 'facilities-3'){
    ?> 
        <a href="javascript:void(0);" id="openReserveFacility" class="btn stock-btn">
            <span class="material-icons">add</span>
        </a>
    <?php }
    } else if($type == 'sales-1' || strpos($link, 'profile.php') == true){
    }else { 
        if($type =='stocks-5' && $actor == 1){

        }else {
            ?>
                <a href=
                    <?php
                    switch($type){
                        case strpos($type, 'stocks') !== false:
                            echo 'javascript:void(0);';
                            break;
                        case strpos($type, 'news') !== false:
                            echo 'body.php?news-1';
                            break;
                        case strpos($type, 'facilities') !== false:
                            echo 'javascript:void(0);';
                            break;
                        case 'sales-2':
                            echo 'body.php?sales-1';
                            break;
                        default:
                            echo "#";
                            break;
                    }
                    ?> id=
                    <?php
                    switch($typeNum){
                        case 1: 
                            echo 'addFacility';
                            break;
                        case 2:
                            if(strpos($type, 'stocks') !== false){
                                echo 'openMemorabilia';
                            }else {
                                echo 'addExpenses';
                            }
                            break;
                        case 3:
                            if(strpos($type, 'facilities') !== false){
                                echo 'openReservationModal';
                            }else {
                                echo 'openNewArrivalModal';
                            }
                            break;
                        default:
                            echo '#';
                            break;
                    }
                    ?>
                    class="btn stock-btn">
                        <span class="material-icons">add</span>
                </a>

            <?php
            if($type == 'stocks-3' && $actor == 1){
            ?>
            <a type="button" href="javascript:void(0);" id="voidProduct" class="btn stock-btn void-btn">
                <span class="material-icons">remove</span>
            </a>
            <?php
            } }
            
        if(strpos($type, 'news') !== false || $type == 'facilities-1' || $type == 'facilities-2' || $type == 'sales-1' || $type == 'stocks-2'|| $type == 'sales-2'){

        }else{
        ?>
        <a type="button" href="javascript:void(0);" id="printReport" class="btn stock-btn print-btn">
            <span class="material-icons">print</span>
        </a>
        <?php  }
    }

    if($actor == 1 && $type == 'stocks-2'){
    ?>
        <a type="button" href="javascript:void(0);" id="edit-pricing" class="btn stock-btn price-btn">
            <span class="material-icons">price_change</span>
        </a>
    <?php
    }
    
    if($actor == 2){
        if($type == 'stocks-1' || $type == 'stocks-5'){
        ?>
        <a type="button" href="#" id="cartView" class="btn stock-btn cart-btn">
            <span class="material-icons">shopping_cart</span>
            <span class="badge" id="cart-badge">10</span>
        </a>
        <?php
        }
        if($type == 'stocks-5' || $type == 'stocks-4'){
            ?>
            <a type="button" href="body.php?stocks-1" class="btn stock-btn store-btn">
                <span class="material-icons">store</span>
            </a>
        <?php
        }
        if($type == 'stocks-1' || $type == 'stocks-4'){ ?>
            <a type="button" href="body.php?stocks-5" class="btn stock-btn event-btn">
            <span class="material-icons">event_available</span>
            </a>
        <?php
        }
    }

}
?>