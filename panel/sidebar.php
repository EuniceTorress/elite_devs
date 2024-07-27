<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1);
?>

<style>
.wrapper {
    display: flex;
    width: 100%;
}

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
    font-size: 15px;
}

#sidebar .sidebar-header p {
    margin: 0;
    font-size: 12px;
    color: silver;
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
    font-size: 14px;
}

#sidebar .list-unstyled .list-group-item {
    font-size: 13px;
    border: none;
    margin-left: 60px;
    background: transparent;
    color: black; 
    transition: all 0.2s ease;
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

.sidebar-link {
    display: flex;
    padding-left: 10px;
    color: black;
    transition: all 0.1s ease;
    margin-bottom: 10px;
}

.sidebar-link:hover,
.sidebar-link.active {
    text-decoration: none !important;
    background-color: rgba(255,0,0,0.2);
    border-left: 2px solid maroon;
    color: black;
    border-radius: 0px 50px 50px 0px;
}

.sidebar-link li .fas{
    border-radius: 50%;
    padding: 10px;
    margin-right: 10px;
}

.sidebar-link li .fa-tachometer-alt {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
}

.sidebar-link li .fa-cash-register {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.sidebar-link li .fa-newspaper {
    background-color: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
}

.sidebar-link li .fa-calendar-check {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.sidebar-link li .fa-file-alt{
    background-color: rgba(65,1,4,0.1);
    color: #410104;
}

.sidebar-link li .fa-boxes{
    background-color: rgba(180,5,203,0.1);
    color: #b405cb;
}

.sidebar-link:hover li .fas{
    background-color: rgba(0,0,0,0.1);
    color: black;
}

.overlay {
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

<div class="overlay" id="overlay"></div>
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
    <a href="user-homepage.php?type=dashboard" type="button" class="sidebar-link <?= $type == 'dashboard' ? 'active' : '' ?>"><li><i class="fas fa-tachometer-alt"></i> Dashboard</li></a>
    <a href="#posDD" data-toggle="collapse" type="button" class="sidebar-link <?= strpos($type, 'sales') !== false ? 'active' : '' ?>"><li><i class="fas fa-cash-register"></i> Sales</li></a>
        <div class="collapse" id="posDD" >
            <a href="user-homepage.php?type=sales-entry1"  class="list-group-item py-1 mt-1 <?= strpos($type, 'entry') !== false ? 'active' : '' ?>"><span>&#8226;</span>Data Entry</a>
            <a href="user-homepage.php?type=sales-records"  class="list-group-item py-1 mb-1 <?= strpos($type, 'records') !== false ? 'active' : '' ?>"><span>&#8226;</span>Records</a>
        </div>
    <a href="user-homepage.php?type=stocks" type="button" class="sidebar-link <?= $type == 'stocks' ? 'active' : '' ?>"><li><i class="fas fa-boxes"></i> Stocks</li></a>
    <a href="user-homepage.php?type=reservations" type="button" class="sidebar-link <?= $type == 'reservations' ? 'active' : '' ?>"><li><i class="fas fa-calendar-check"></i> Reservations</li></a>
    <a href="user-homepage.php?type=news" type="button" class="sidebar-link <?= $type == 'news' ? 'active' : '' ?>"><li><i class="fas fa-newspaper"></i> News</li></a>
    <a href="user-homepage.php?type=logs" type="button" class="sidebar-link <?= $type == 'logs' ? 'active' : '' ?>"><li><i class="fas fa-file-alt"></i> Logs</li></a>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

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
    const overlay = document.getElementById('overlay');

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

    const links = dropdown.querySelectorAll('a');
    links.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            const collapseElement = document.getElementById('posDD');
            if (collapseElement.classList.contains('collapse')) {
                collapseElement.classList.remove('collapse');
                collapseElement.classList.add('show');
            }
        }
    });
});
</script>
