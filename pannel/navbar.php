<style>
    .navbar {
        padding: 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        box-shadow: inset 0 -5px 10px rgba(0, 0, 0, 0.3);
        background-color: #ECFFE6;
    }

    .navbar .img-brand {
        height: 30px;
        object-fit: contain;
    }

    .navbar .nav-link {
        font-size: 18px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .navbar .nav-link:hover {
        color: maroon;
        transform: scale(1.05);
    }

    .navbar .menu-btn {
        background: none;
        border: none;
        cursor: pointer;
    }

    .notification-wrapper {
        position: relative;
        display: inline-block;
    }

    .ntf-icon {
        position: relative;
        cursor: pointer;
        background: none;
        border: none;
    }

    .ntf-icon i {
        color: #333;
        font-size: 20px;
    }

    .notification-badge {
        position: absolute;
        right: 20px;
        background-color: #E4003A;
        color: white;
        border-radius: 50%;
        padding: 1px 6px;
        font-size: 11px;
        font-weight: bold;
    }

    .notification-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        border: 1px solid #ddd;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 250px;
        z-index: 2;
    }

    .notification-dropdown ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .notification-dropdown ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .notification-dropdown ul li:hover {
        background-color: #f8f9fa;
    }

    .navbar .menu-btn:focus,
    .navbar .menu-btn:active,
    .navbar .ntf-icon:focus,
    .navbar .ntf-icon:active {
        outline: none; 
        box-shadow: none; 
    }
</style>
<nav class="navbar">
        <div class="container-fluid">
            <button type="button" id="toggleSidebar" class="btn menu-btn">
                <i class="fas fa-bars nav-link"></i>
            </button>
            <a class="navbar-brand" href="#">
                <img class="img-brand" src="img/rgo.png" alt="Brand Logo">
            </a>
            <div class="notification-wrapper ml-auto">
                <button class="btn ntf-icon" id="notificationIcon">
                    <i class="fas fa-bell nav-link"></i>
                    <span class="notification-badge">3</span>
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

    <!-- notification.js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const notificationIcon = document.getElementById('notificationIcon');
    const notificationDropdown = document.getElementById('notificationDropdown');

    notificationIcon.addEventListener('click', function() {
        // Toggle the display property of the dropdown
        if (notificationDropdown.style.display === 'block') {
            notificationDropdown.style.display = 'none';
        } else {
            notificationDropdown.style.display = 'block';
        }
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener('click', function(event) {
        if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.style.display = 'none';
        }
    });
});
</script>