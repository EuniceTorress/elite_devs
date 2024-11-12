<nav class="navbar">
    <div class="sidebar-collapsed" id="sidebar-collapsed">
        <span class="menu-icon material-icons">menu</span>
        <div class="sidebar-dropdown" id="sidebar-dropdown">
            <p>Notification 1</p>
            <p>Notification 2</p>
            <p>Notification 3</p>
        </div>
    </div>
    <div class="logo-container" id="logo">
        <img src="../../src/img/rgo.jpg" alt="RGO" class="logo">
    </div>
   <?php
   include 'nav-panel.php';
   if(strpos($type, 'sales') !== false && $typeNum ==1 || $type == 'dashboard' || strpos($link, 'profile.php') == true){
    ?>
    <?php
   }else {
   ?>
    <div class="search-container">
        <input type="text" placeholder="Search..." class="search-input" id="search-input">
        <span class="search-icon material-icons">search</span>
    </div>
    <?php } ?>
    <div class="notification" id="notification-icon">
        <span class="badge">3</span>
        <span class="material-icons">notifications</span>
        <div class="dropdown" id="notification-dropdown">
            <p>Notification 1</p>
            <p>Notification 2</p>
            <p>Notification 3</p>
        </div>
    </div>
    <div class="profile-container" id="profile-icon">
        <img src="<?php echo $profile; ?>" alt="Profile" class="profile-image">
    </div>
    <ul class="profile-dropdown" id="profile-dropdown">
        <?php if ($role == 'System Admin'): ?>
            <li><a href="../../sql/role.php?0"><span class="material-icons">admin_panel_settings</span> <p>System Admin</p></a></li>
            <li><a href="../../sql/role.php?1"><span class="material-icons">work</span><p>RGO Staff</p></a></li>
            <li><a href="../../sql/role.php?2"><span class="material-icons">person</span><p>End User</p></a></li>
        <?php endif; ?>
        <li><a href="profile.php"><span class="material-icons">settings</span><p>Profile Settings</p></a></li>
        <li><a href="../../sql/logout.php"><span class="material-icons">logout</span><p>Logout</p></a></li>
    </ul>
</nav>
