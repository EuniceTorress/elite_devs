<div class="row" id="all-container">

        <div class="table-responsive">
        <?php

        if($actor == 1){
            switch ($typeNum){
                case 1:
                    include 'facility.php';
                    break;
                case 2:
                    include 'manpower.php';
                    break;
                case 3:
                    include 'rentals.php';
                    break;
                default: 
                        break;
                }
        }else {
            include 'c-rentals.php';
        }
                    ?>

    </div>
</div>