<nav class="sidebar">
    <div class="sidebar-header">
        <button class="menu-icon material-icons" id="side-menu" onclick="toggleSidebar()">menu</button>
        <div class="user-details">
            <span><?php echo $name; ?></span>
            <p><?php echo $role; ?></p>
        </div>
    </div>
    <hr class="s-divider">
    <ul>
        <li class="<?= $type == 'dashboard' ? 'active' : '' ?>"><a href="body.php?dashboard">
            <?php
                if($actor == 2){
            ?>
                <span class="material-icons">dashboard</span><p>Home</p>
            <?php
            } else {
            ?>
               <span class="material-icons">equalizer</span><p>Dashboard</p>
            <?php
            }
            ?>
        </a></li>
        <?php if($actor != 0) { ?>
        <li class="<?= strpos($type, 'stocks') !== false ? 'active' : '' ?>">
            <a href="javascript:void(0)" 
               onclick="toggleDropdown('stocksDropdown', 'stocksArrow', this)" 
               onmouseenter="showDropdownOnHover('stocksDropdown', 'stocksArrow')" 
               onmouseleave="hideDropdownOnLeave('stocksDropdown', 'stocksArrow')">
               <span class="material-icons">archive</span>
                <p>Stocks</p>
                <span class="material-icons dropdown-arrow" id="stocksArrow">expand_more</span>
            </a>
            <ul id="stocksDropdown" class="sidebar-dropdown-content" 
                onmouseenter="keepDropdownOpen(event, 'stocksDropdown', 'stocksArrow')" 
                onmouseleave="hideDropdownOnLeave('stocksDropdown', 'stocksArrow')">
                <?php if($actor == 1){ ?>
                <li class="<?= $type == 'stocks-3' ? 'active' : '' ?>"><a href="body.php?stocks-3"><span class="material-icons">inventory</span><p>Inventory</p></a></li>
                <li class="<?= $type == 'stocks-2' ? 'active' : '' ?>"><a href="body.php?stocks-2"><span class="material-icons">school</span><p>Memorabilia</p></a></li>
                <?php }else { ?>
                    <li class="<?= $type == 'stocks-1' ? 'active' : '' ?>"><a href="body.php?stocks-1"><span class="material-icons">store</span><p>Merchandise</p></a></li>
                    <li class="<?= $type == 'stocks-4' ? 'active' : '' ?>"><a href="body.php?stocks-4"><span class="material-icons">shopping_cart</span><p>Cart</p></a></li>
                <?php } ?>
                <li class="<?= $type == 'stocks-5' ? 'active' : '' ?>"><a href="body.php?stocks-5"><span class="material-icons">event_available</span><p>Reservation</p></a></li>
            </ul>
        </li>

        <li class="<?= strpos($type, 'facilities') !== false ? 'active' : '' ?>">
            <?php if($actor == 1){ ?>
            <a href="javascript:void(0)" 
               onclick="toggleDropdown('facilitiesDropdown', 'facilitiesArrow', this)" 
               onmouseenter="showDropdownOnHover('facilitiesDropdown', 'facilitiesArrow')" 
               onmouseleave="hideDropdownOnLeave('facilitiesDropdown', 'facilitiesArrow')">
               <span class="material-icons">business</span>
                <p>Facilities</p>
                <span class="material-icons dropdown-arrow" id="facilitiesArrow">expand_more</span>
            </a>
            <ul id="facilitiesDropdown" class="sidebar-dropdown-content" 
                onmouseenter="keepDropdownOpen(event, 'facilitiesDropdown', 'facilitiesArrow')" 
                onmouseleave="hideDropdownOnLeave('facilitiesDropdown', 'facilitiesArrow')">
                <li class="<?= $type == 'facilities-1' ? 'active' : '' ?>"><a href="body.php?facilities-1"><span class="material-icons">apartment</span><p>Facility</p></a></li>
                <li class="<?= $type == 'facilities-2' ? 'active' : '' ?>"><a href="body.php?facilities-2"><span class="material-icons">receipt</span><p>Expenses</p></a></li>
                <li class="<?= $type == 'facilities-3' ? 'active' : '' ?>"><a href="body.php?facilities-3"><span class="material-icons">event</span><p>Rentals</p></a></li>
            </ul>
            <?php } else { ?>
                <a href="body.php?facilities-3"><span class="material-icons">event</span><p>Rentals</p></a>
            <?php } ?>
        </li>
        <?php if($actor == 1){ ?>
        <li class="<?= strpos($type, 'sales') !== false ? 'active' : '' ?>">
            <a href="javascript:void(0)" 
               onclick="toggleDropdown('salesDropdown', 'salesArrow', this)" 
               onmouseenter="showDropdownOnHover('salesDropdown', 'salesArrow')" 
               onmouseleave="hideDropdownOnLeave('salesDropdown', 'salesArrow')">
                <span class="material-icons">attach_money</span>
                <p>Sales</p>
                <span class="material-icons dropdown-arrow" id="salesArrow">expand_more</span>
            </a>
            <ul id="salesDropdown" class="sidebar-dropdown-content" 
                onmouseenter="keepDropdownOpen(event, 'salesDropdown', 'salesArrow')" 
                onmouseleave="hideDropdownOnLeave('salesDropdown', 'salesArrow')">
                <li class="<?= $type == 'sales-1' ? 'active' : '' ?>"><a href="body.php?sales-1"><span class="material-icons">input</span><p>Entry</p></a></li>
                <li class="<?= $type == 'sales-2' ? 'active' : '' ?>"><a href="body.php?sales-2"><span class="material-icons">receipt_long</span><p>Record</p></a></li>
            </ul>
        </li>
        <li class="<?= strpos($type, 'news') !== false ? 'active' : '' ?>">
            <a href="javascript:void(0)" 
            onclick="toggleDropdown('newsDropdown', 'newsArrow', this)" 
            onmouseenter="showDropdownOnHover('newsDropdown', 'newsArrow')" 
            onmouseleave="hideDropdownOnLeave('newsDropdown', 'newsArrow')">
            <span class="material-icons">article</span>
                <p>News Feed</p>
                <span class="material-icons dropdown-arrow" id="newsArrow">expand_more</span>
            </a>
            <ul id="newsDropdown" class="sidebar-dropdown-content" 
                onmouseenter="keepDropdownOpen(event, 'newsDropdown', 'newsArrow')" 
                onmouseleave="hideDropdownOnLeave('newsDropdown', 'newsArrow')">
                <li><a href="body.php?news-1"><span class="material-icons">edit</span><p>Create Post</p></a></li>
                <li><a href="body.php?news-2"><span class="material-icons">rss_feed</span><p>Manage Feed</p></a></li>
            </ul>
        </li>
    <?php } } if($actor == 0) { ?>
        <li class="<?= $type == 'log' ? 'active' : '' ?>"><a href="body.php?log"><span class="material-icons">description</span><p>Logs</p></a></li>
    <?php } ?>
    </ul>
</nav>
