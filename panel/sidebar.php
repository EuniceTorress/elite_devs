<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
?>

<style>

#sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: -250px;
    transition: 0.3s;
    z-index: 3;
    background-color: rgba(255,255,255,0.9);
    transition: all 0.3s ease;
}

#sidebar.active {
    left: 0;
}

#sidebar .sidebar-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
}

#sidebar .sidebar-header .profile {
    display: flex;
    align-items: center;
    border-bottom: 0.5px solid rgba(0,0,0,0.1);
    padding-bottom: 20px;
    width: 100%;
    margin-bottom: 5px;
}

#sidebar .sidebar-header .profile img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    border: 1px solid rgba(0,0,0,0.5);
    margin-right: 10px;
    margin-left: 15px;
}

#sidebar .sidebar-header .profile .user-details {
    display: column;
}

#sidebar .sidebar-header h3 {
    margin: 10px 0 5px 0;
    font-size: 0.8rem;
}

#sidebar .sidebar-header p {
    margin: 0;
    font-size: 0.6rem;
    color: maroon;
}

#sidebar .list-unstyled {
    padding: 0;
    margin: 0;
    margin-top: 10px;
}

#sidebar .list-unstyled li {
    padding: 6px 10px;
}

#sidebar .list-unstyled li {
    color: black;
    text-decoration: none;
    display: block;
    font-size: 0.8rem;
}

#sidebar .list-unstyled .list-group-item {
    font-size: 13px;
    border: none;
    margin-left: 60px;
    background: transparent;
    color: black; 
    transition: all 0.2s ease;
    margin-top: -5px;
}

#sidebar .list-unstyled .list-group-item:hover,
#sidebar .list-unstyled .list-group-item.active{
    text-decoration: none !important;
    color: maroon;
    font-weight: bold;
}

#sidebar .list-unstyled .list-group-item span {
    display: none;
    position: absolute;
    left: 0px;
}

#sidebar .list-unstyled .list-group-item:hover span,
#sidebar .list-unstyled .list-group-item.active span{
    display: flex;
}

#sidebar .list-unstyled li a:hover {
    background: #495057;
    border-radius: 4px;
}

#sidebar .sidebar-link {
    display: flex;
    padding-left: 10px;
    color: black;
    transition: all 0.1s ease;
    margin-bottom: 10px;
}

#sidebar .sidebar-link:hover,
#sidebar .sidebar-link.active {
    text-decoration: none !important;
    background-color: rgba(255,0,0,0.2);
    border-left: 2px solid maroon;
    color: black;
    border-radius: 0px 50px 50px 0px;
}

#sidebar .sidebar-link li .fas{
    text-align: center;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    font-size: 13px;
    border-radius: 50%;
    padding: 10px;
    margin-right: 10px;
}

#sidebar .sidebar-link li .fa-tachometer-alt {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
}

#sidebar .sidebar-link li .fa-cash-register,
#sidebar .sidebar-link li .fa-shopping-cart{
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

#sidebar .sidebar-link li .fa-newspaper {
    background-color: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
}

#sidebar .sidebar-link li .fa-calendar-check {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

#sidebar .sidebar-link li .fa-building {
    background-color: rgba(65,1,4,0.1);
    color: #410104;
}

#sidebar .sidebar-link li .fa-clipboard {
    background-color: rgba(47, 54, 69, 0.1);
    color: #2F3645;
}

#sidebar .sidebar-link li .fa-boxes {
    background-color: rgba(180,5,203,0.1);
    color: #b405cb;
}

#sidebar .sidebar-link:hover li .i{
    background-color: rgba(0,0,0,0.1);
    color: black;
}

#sidebar .sidebar-link li .dropdown-icon {
    right: 5px;
    position: absolute;
    padding: 10px;
    font-size: 10px;
    transition: transform 0.3s ease;
    color: maroon;
}

#sidebar .dropdown-icon-c {
    transform: rotate(180deg);  
}

#sidebar-overlay{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 2;
}

</style>

<div class="overlay" id="sidebar-overlay"></div>
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="profile">
            <img src="<?php echo $profile; ?>" alt="Profile Image">
            <div class="user-details">
                <h3><?php echo $name; ?></h3>
                <p><?php echo $role; ?></p>
            </div>
        </div>
    </div>
    <ul class="list-unstyled">
        <?php if ($actor == 1){ ?> <a href="user-homepage.php?type=dashboard" type="button" class="sidebar-link <?= $type == 'dashboard' ? 'active' : '' ?>"><li><i class="fas fa-tachometer-alt i"></i> Dashboard</li></a> <?php } ?>
        <?php if ($actor == 1 || $actor == 2){ ?> <a href="user-homepage.php?type=stocks" type="button" class="sidebar-link <?= strpos($type, 'stocks') !== false ? 'active' : '' ?>"><li><i class="fas fa-boxes i"></i> Stocks</li></a> <?php } ?>
        <?php if ($actor == 1){ ?> 
        <a href="user-homepage.php?type=facilities" type="button" class="sidebar-link <?= $type == 'facilities' ? 'active' : '' ?>"><li><i class="fas fa-building i"></i> Facilities</li></a>
        <a href="user-homepage.php?type=sales" type="button" class="sidebar-link <?= strpos($type, 'sales') !== false ? 'active' : '' ?>"><li><i class="fas fa-cash-register i"></i>Sales</li></a>
        <?php } ?>
        <?php if ($actor == 1 || $actor == 2){ 
            if ($actor == 2){?> <a href="user-homepage.php?type=cart" type="button" class="sidebar-link <?= strpos($type, 'cart') !== false ? 'active' : '' ?>"><li><i class="fas fa-shopping-cart"></i></i> Cart</li></a> <?php } ?>
        <a id="rb" href="#rDD" data-toggle="collapse" type="button" class="sidebar-link <?= strpos($type, 'reservations') !== false ? 'active' : '' ?>"><li><i class="fas fa-calendar-check i"></i> Reservations<span id="rDDB" class="fas fa-chevron-down dropdown-icon"></span></li></a>
            <div class="collapse" id="rDD" >
                <a href="user-homepage.php?type=reservations-facility"  class="list-group-item py-1 mt-1 <?= strpos($type, 'facility') !== false ? 'active' : '' ?>"><span>&#8226;</span>Facility</a>
                <a href="user-homepage.php?type=reservations-item"  class="list-group-item py-1 mb-1 <?= strpos($type, 'item') !== false ? 'active' : '' ?>"><span>&#8226;</span>Item</a>
            </div>
        <a href="user-homepage.php?type=news" type="button" class="sidebar-link <?= $type == 'news' ? 'active' : '' ?>"><li><i class="fas fa-newspaper i"></i> News</li></a>
        <?php } ?>
        <?php if ($actor == 0){ ?><a href="user-homepage.php?type=logs" type="button" class="sidebar-link <?= $type == 'logs' ? 'active' : '' ?>"><li><i class="fas fa-clipboard i"></i> Logs</li></a> <?php } ?>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleSidebar.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    toggleSidebar.addEventListener('click', function() {
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
            overlay.style.display = 'none';
        } else {
            sidebar.style.display = 'block';
            overlay.style.display = 'block';
        }
    });

    overlay.addEventListener('click', function() {
        sidebar.style.display = 'none';
        overlay.style.display = 'none';
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const currentUrl = window.location.href;

    const dropdown = document.getElementById('posDD');
    const dropdown2 = document.getElementById('rDD');

    const links = dropdown.querySelectorAll('a');
    links.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            const buttonID = document.getElementById('posDDB');
            const collapseElement = document.getElementById('posDD');
            if (collapseElement.classList.contains('collapse')) {
                collapseElement.classList.remove('collapse');
                collapseElement.classList.add('show');
                buttonID.classList.add('dropdown-icon-c');
            }
        }
    });

    const links2 = dropdown2.querySelectorAll('a');
    links2.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            const buttonID = document.getElementById('rDDB');
            const collapseElement = document.getElementById('rDD');
            if (collapseElement.classList.contains('collapse')) {
                collapseElement.classList.remove('collapse');
                collapseElement.classList.add('show');
                buttonID.classList.add('dropdown-icon-c');
            }
        }
    });
});

function dropdownAnim(buttonId, ddContent) {
    const btnID = document.getElementById(buttonId);
    btnID.classList.toggle('dropdown-icon-c');
}

document.getElementById('pb').onclick = function () {
    dropdownAnim('posDDB', 'posDD');
};

document.getElementById('rb').onclick = function () {
    dropdownAnim('rDDB', 'rDD');
};
</script>
