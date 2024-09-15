<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 

?>

<style>
.navbar {
    box-shadow: inset 0 -5px 10px rgba(0, 0, 0, 0.3);
    background-color: maroon;
    padding: 5px 10px;
    width: 100%;
    height: 60px;
    z-index: 2;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar-container {
    display: flex;
    align-items: center;
    height: 100%;
    flex: 1;
}

.navbar .stock-btn {
    color: white;
    background-color: green;
    font-size: 0.8rem;
    outline: none;
    box-shadow: none;
    margin-left: 10px; 
    width: 9rem;
}

.navbar .stock-btn:hover {
    background-color: black;
}

.navbar .view-btn {
    background-color: rgba(255, 159, 64, 0.5);
}

.navbar .form-control {
    border: 0.5px solid rgba(128, 5, 5, 0.4);
    border-radius: 10px;
    background-color: #FFFFFF;
    color: #000000;
    font-size: 0.8rem;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: justify;
    width: 30%;
}

.navbar .form-control::placeholder {
    opacity: 0.4;
    color: #800000;
    padding-left: 17px;
}

.navbar .form-control:focus {
    outline: none;
    background-color: #f9f9f9;
    border: none;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.3);
}

.navbar .img-brand {
    height: 40px;
    width: auto;
    object-fit: cover;
    border-radius: 50%;
}

.navbar .nav-link {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.navbar .nav-link:hover {
    color: rgba(0, 0, 0, 0.8);
    transform: scale(1.05);
}

.navbar .menu-btn {
    background: none;
    border: none;
    cursor: pointer;
}

.navbar .print-btn {
    background-color: #180161;
}

.navbar .fa-print {
    font-size: 12px; 
    padding: 2px 5px; 
}

.navbar .notification-wrapper {
    display: flex;
    align-items: center;
    position: relative;
}

.navbar .profile-wrapper {
    display: flex;
    align-items: center;
}

.profile-wrapper .profile-icon {
    height: 40px;
    width: 40px;
    object-fit: cover;
    border-radius: 50%;
    cursor: pointer;
}

.navbar .profile-wrapper .username {
    color: white;
    font-size: 0.8rem;
    margin: 0 10px;
}

.navbar .profile-wrapper,
.navbar .profile-wrapper img,
.navbar .profile-wrapper .username,
.navbar .profile-wrapper .dropdown-icon {
    cursor: pointer;
}

.navbar .profile-wrapper:hover .username,
.navbar .profile-wrapper:hover .dropdown-icon {
    color: black;
}

.navbar .profile-wrapper .dropdown-icon {
    font-size: 15px;
    color: white;
    cursor: pointer;
}

.navbar .ntf-icon {
    padding: 0 10px 0 0;
}

.navbar .fa-search {
    position: absolute;
    opacity: 0.4;
    color: #800000;
    font-size: 0.7rem;
    padding: 5px 0 5px 0;
    left: 11%;
}

.navbar .notification-badge {
    position: absolute;
    top: 0;
    left: 13%;
    padding: 4px;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    border-radius: 50%;
    font-size: 0.5rem;
    font-weight: bold;
    width: 20px;
    height: 20px;
}

.navbar .notification-dropdown, .profile-dropdown {
    display: none;
    position: absolute;
    top: 60px;
    background-color: rgba(255, 255, 255, 0.9);
    border: 1px solid #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    z-index: 2;
}

.navbar .notification-dropdown {
    width: 220px;
    top: 40px;
}

.navbar .profile-dropdown {
    width: 150px;
    right: 0px;
    top: 40px;
}

.navbar .notification-dropdown ul, .profile-dropdown ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.navbar .notification-dropdown ul li, .profile-dropdown ul li {
    padding: 10px;
    cursor: pointer;
    font-size: 13px;
    text-align: justify;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.navbar .notification-dropdown ul li a, .profile-dropdown ul li a {
    display: block;
    text-decoration: none;
    color: inherit;
}

.navbar .notification-dropdown ul li:last-child, .profile-dropdown ul li:last-child {
    border-bottom: none;
}

.navbar .notification-dropdown ul li:hover, .profile-dropdown ul li:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

.navbar .notification-dropdown ul li:first-child:hover {
    border-radius: 10px 10px 0 0;
}

.navbar .notification-dropdown ul li:last-child:hover {
    border-radius: 0 0 10px 10px;
}

.navbar .menu-btn:focus,
.navbar .menu-btn:active,
.navbar .ntf-icon:focus,
.navbar .ntf-icon:active,
.navbar .profile-icon:focus,
.navbar .profile-icon:active,
.navbar .dropdown-icon:focus,
.navbar .dropdown-icon:active {
    outline: none;
    box-shadow: none;
}

@media (max-width: 768px) {
    .navbar .nav-link {
        font-size: 15px;
    }

    .navbar .img-brand {
        height: 25px;
        width: 25px;
    }

    .notification-badge {
        font-size: 9px;
        padding: 1px 4px;
    }

    .notification-dropdown {
        width: 200px;
    }

    .navbar .profile-wrapper .username {
        font-size: 14px;
    }

    .navbar .profile-wrapper .username:hover {
        cursor: pointer;
    }

    .navbar .profile-wrapper .profile-icon {
        height: 30px;
        width: 30px;
    }
}

.navbar #purchaseType {
    font-size: 0.8rem;
    border-radius: 10px;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <button type="button" id="toggleSidebar" class="btn menu-btn">
            <i class="fas fa-bars nav-link"></i>
        </button>
        <a class="navbar-brand" href="#">
            <img class="img-brand" src="<?php echo $logo; ?>" alt="Logo">
        </a>
        <?php if($type == 'dashboard' && $actor == 2) { ?>
            <i class="fas fa-search"></i><input type="text" id="searchInput" class="form-control" placeholder="Search items...">
        <?php } ?>
        <?php if($type == 'stocks' || $type == 'facilities' ) { ?>
            <i class="fas fa-search"></i><input type="text" id="searchInput" class="form-control" placeholder="Search items...">
        <?php } ?>
    </div>
    <?php if(strpos($type, 'stocks') !== false && $actor == 1){ ?>
    <div class="navbar-actions">
        <a type="button" href="" id="openNewArrivalModal" class="btn stock-btn">+ New Arrival</a>
        <a type="button" href="" id="printReport" class="btn stock-btn print-btn">
            <i class="fa fa-print"></i> Print Report
        </a>
    </div>
    <?php } else if ($type == 'facilities'){ ?>
        <div class="navbar-actions">
        <a type="button" href="#" id="openFacilityModal" class="btn stock-btn">+ Add Facility</a>
        <a type="button" href="#" id="openManpowerModal" class="btn stock-btn print-btn">+ Add Manpower</a>
    </div><?php } else if ($type == 'reservations-facility') {?>
        <a type="button" class="btn stock-btn print-btn" onclick="showCalendarModal()"><i class="fa fa-eye mr-2"></i>View Calendar</a>
        <a type="button" href="#" id="openReservationModal" class="btn stock-btn">+ Add Reservation</a>
        <?php } else if ($type == 'news' && $actor == 1){ ?>
            <a type="button" href="#" id="openNewsModal" class="btn stock-btn">+ Create News</a>
        <?php } else if ($type == 'reservations-item'){ ?>
            <a type="button" class="btn stock-btn print-btn" onclick="showCalendarModal()"><i class="fa fa-eye mr-2"></i>View Calendar</a>
            <a type="button" href="#" id="openReservationModal" class="btn stock-btn">+ Add Reservation</a>
       <?php } else if (strpos($type, 'sales') !== false){ ?>
        <div class="navbar-actions">
        <a type="button" href="" id="printReport" class="btn stock-btn print-btn">
            <i class="fa fa-print"></i> Print Report
        </a>
    </div>
       <?php } ?>
    <div class="notification-wrapper">
        <button class="btn ntf-icon" id="notificationIcon">
            <i class="fas fa-bell nav-link"></i>
            <span class="notification-badge" id="badge">1</span>
        </button>
        <div class="notification-dropdown" id="notificationDropdown">
            <ul>
                <li><a href="#">Notification 1</a></li>
                <li><a href="#">Notification 2</a></li>
                <li><a href="#">Notification 3</a></li>
            </ul>
        </div>
        <div class="profile-wrapper" id="dropdownIcon">
            <img class="profile-icon" src="<?php echo $profile; ?>" alt="Profile" id="profileIcon">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-caret-down dropdown-icon"></i>
        </div>
        <div class="profile-dropdown" id="profileDropdown">
            <ul>
                <?php if ($role == 'System Admin'){ ?>
                    <li><a href="../sql/role.php?0"><i class="fas fa-eye mr-3"></i>System Admin</a></li>
                    <li><a href="../sql/role.php?1"><i class="fas fa-eye mr-4"></i>RGO Staff</a></li>
                    <li><a href="../sql/role.php?2"><i class="fas fa-eye mr-4"></i>End users</a></li>
                <?php } else { ?>
                <li><a href="#">View Profile</a></li>
                <li><a href="#">Change Password</a></li>
                <?php } ?>
                <li><a type="button" href="../sql/logout.php" class="text-center">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationIcon = document.getElementById('notificationIcon');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notifBadge = document.getElementById('badge');
        const profileIcon = document.getElementById('profileIcon');
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownIcon = document.getElementById('dropdownIcon');
        const searchInput = document.getElementById('search');

        notificationIcon.addEventListener('click', function() {
            if (notificationDropdown.style.display === 'block') {
                notificationDropdown.style.display = 'none';
                notifBadge.style.display = 'block';
            } else {
                notificationDropdown.style.display = 'block';
                notifBadge.style.display = 'none';
            }
        });

        dropdownIcon.addEventListener('click', function() {
            if (profileDropdown.style.display === 'block') {
                profileDropdown.style.display = 'none';
            } else {
                profileDropdown.style.display = 'block';
            }
        });

        document.addEventListener('click', function(event) {
            if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
                notifBadge.style.display = 'block';
            }

            if (!profileIcon.contains(event.target) && !profileDropdown.contains(event.target) && !dropdownIcon.contains(event.target)) {
                profileDropdown.style.display = 'none';
            }
        });

    });

document.getElementById('openReservationModal').addEventListener('click', function(event) {
    event.preventDefault();
    var myModal = new bootstrap.Modal(document.getElementById('rentFacilityModal'));
    myModal.show(); 
});

</script>

