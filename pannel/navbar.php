<style>
.navbar {
    box-shadow: inset 0 -5px 10px rgba(0, 0, 0, 0.3);
    background-color: rgba(128,2,2,0.8);
    padding: 10px 20px;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    height: 58px;
    z-index: 2;
}

.navbar-container {
    display: flex;
    align-items: center;
    height: 100%; 
}

.navbar .img-brand {
    height: 40px;
    width: auto;
    object-fit: cover;
    border-radius: 50%;
}

.navbar .nav-link {
    font-size: 17px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.navbar .nav-link:hover {
    color: rgba(0,0,0,0.8);
    transform: scale(1.05);
}

.navbar .menu-btn {
    background: none;
    border: none;
    cursor: pointer;
}

.notification-wrapper {
    position: absolute;
    right: 20px;
}

.ntf-icon {
    position: relative;
    cursor: pointer;
    background: none;
    border: none;
}

.notification-badge {
    position: absolute;
    top: 0px;
    right: 10px;
    padding: 5px;
    background-color: rgba(0,0,0,0.6);
    color: white;
    border-radius: 50%;
    font-size: 11px;
    font-weight: bold;
    width: 25px;
    height: 25px;
}

.notification-dropdown {
    display: none;
    position: absolute;
    top: 40px;
    right: 0;
    background-color: rgba(255,255,255,0.9);
    border: 1px solid #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    width: 250px;
    border-radius: 10px;
    z-index: 2;
}

.notification-dropdown ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.notification-dropdown ul li {
    padding: 10px;
    cursor: pointer;
    font-size: 13px;
    text-align: justify;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.notification-dropdown ul li:last-child {
    border-bottom: none;
}

.notification-dropdown ul li:hover {
    background-color: rgba(0,0,0,0.1);
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
.navbar .ntf-icon:active {
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
}
</style>
<nav class="navbar">
    <div class="navbar-container">
        <button type="button" id="toggleSidebar" class="btn menu-btn">
            <i class="fas fa-bars nav-link"></i>
        </button>
        <a class="navbar-brand" href="#">
            <img class="img-brand" src="img/rgo.jpg" alt="Brand Logo">
        </a>
        <div class="notification-wrapper">
            <button class="btn ntf-icon" id="notificationIcon">
                <i class="fas fa-bell nav-link"></i>
                <span class="notification-badge" id="badge">1</span>
            </button>
            <div class="notification-dropdown" id="notificationDropdown">
                <ul>
                    <li>Notification 1</li>
                    <li>Notification 2</li>
                    <li>Notification 3</li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationIcon = document.getElementById('notificationIcon');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notifBadge = document.getElementById('badge')

        notificationIcon.addEventListener('click', function() {
            if (notificationDropdown.style.display === 'block') {
                notificationDropdown.style.display = 'none';
                notifBadge.style.display = 'block';
            } else {
                notificationDropdown.style.display = 'block';
                notifBadge.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
                notifBadge.style.display = 'block';
            }
        });
    });
</script>