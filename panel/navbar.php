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
}

.navbar .stock-btn {
    color: white;
    background-color: green;
    margin-left: auto;
    font-size: 13px;
    outline: none;
    box-shadow: none;
}

.navbar .stock-btn:hover {
    background-color: black;
}

.navbar .form-control {
    border-radius: 10px 0 0 10px;
    padding: 0.5rem;
    border: 1px solid rgba(0,0,0,0.3);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 15px;
    min-width: 100%;
}

.navbar .form-control::placeholder {
    font-size: 13px;
    color: #6c757d;
}

.navbar .form-control:focus {
    border-color: maroon;
    outline: none;
    box-shadow: 0 0 0 0.1rem rgba(128,0,0,0.2);
}

.navbar .search-btn {
    border-radius: 0 10px 10px 0;
    border: none;
    margin-left: -1px;
    background-color: white;
    color: black;
    cursor: pointer;
    padding: 0.35rem 0.5rem;
    font-size: 15px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.navbar .search-btn:hover {
    background-color: black;
    color: white;
}

.navbar .search-btn:active, .search-btn:focus {
    border: none;
    outline: none;
    box-shadow: none;
}

.navbar .img-brand {
    height: 40px;
    width: auto;
    object-fit: cover;
    border-radius: 50%;
}

.navbar .nav-link {
    font-size: 17px;
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

.notification-wrapper {
    display: flex;
    align-items: center;
    position: relative;
}

.notification-wrapper .ntf-icon {
    margin-left: 20px;
}

.profile-wrapper {
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

.profile-wrapper .username {
    color: white;
    font-size: 16px;
    margin: 0 10px;
}

.profile-wrapper,
.profile-wrapper img,
.profile-wrapper .username,
.profile-wrapper .dropdown-icon {
    cursor: pointer;
}

.profile-wrapper:hover .username,
.profile-wrapper:hover .dropdown-icon {
    color: black;
}

.profile-wrapper .dropdown-icon {
    font-size: 15px;
    color: white;
    cursor: pointer;
}

.notification-badge {
    position: absolute;
    top: 0;
    left: 55px;
    padding: 5px;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    border-radius: 50%;
    font-size: 11px;
    font-weight: bold;
    width: 25px;
    height: 25px;
}

.notification-dropdown, .profile-dropdown {
    display: none;
    position: absolute;
    top: 60px;
    background-color: rgba(255, 255, 255, 0.9);
    border: 1px solid #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    z-index: 2;
}

.notification-dropdown {
    width: 220px;
    top: 40px;
}

.profile-dropdown {
    width: 150px;
    right: 0px;
    top: 40px;
}

.notification-dropdown ul, .profile-dropdown ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.notification-dropdown ul li, .profile-dropdown ul li {
    padding: 10px;
    cursor: pointer;
    font-size: 13px;
    text-align: justify;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.notification-dropdown ul li a, .profile-dropdown ul li a {
    display: block;
    text-decoration: none;
    color: inherit;
}

.notification-dropdown ul li:last-child, .profile-dropdown ul li:last-child {
    border-bottom: none;
}

.notification-dropdown ul li:hover, .profile-dropdown ul li:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

.notification-dropdown ul li:first-child:hover {
    border-radius: 10px 10px 0 0;
}

.notification-dropdown ul li:last-child:hover {
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

    .profile-wrapper .username {
        font-size: 14px;
    }

    .profile-wrapper .username:hover {
        cursor: pointer;
    }

    .profile-wrapper .profile-icon {
        height: 30px;
        width: 30px;
    }
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
        <?php if($type == 'stocks') { ?>
        <input type="text" class="form-control" id="search" name="search" placeholder="Search an item..">
        <button class="search-btn" id="searchButton">
            <i class="fas fa-search"></i>
        </button>
        <?php } ?>

    </div>
    <?php if($type == 'stocks'){echo '<a type="button" href="" class="btn stock-btn">+ New Arrival</a>';}
    ?>
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
                <li><a href="#">View Profile</a></li>
                <li><a href="#">Change Password</a></li>
                <li><a type="button" href="../sql/logout.php">Logout</a></li>
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
        const searchButton = document.getElementById('searchButton');
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

        searchButton.addEventListener('click', function() {
            alert('Search for: ' + searchInput.value);
        });

        searchInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                searchButton.click();
            }
        });
    });
</script>
