<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
</head>
<body>
    <header>
        <div class="logo">MyWebsite</div>
        <nav>
            <a href="home.html">Home</a>
            <a href="settings.html">Settings</a>
            <a href="logout.html">Logout</a>
        </nav>
    </header>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 1em;
    text-align: center;
}

header .logo {
    font-size: 1.5em;
    margin-bottom: 0.5em;
}

header nav a {
    color: white;
    margin: 0 1em;
    text-decoration: none;
}

main {
    padding: 2em;
}

.profile-picture img {
    max-width: 150px;
    border-radius: 50%;
}

form {
    margin-bottom: 1em;
}

label {
    display: block;
    margin-top: 0.5em;
}

input, select {
    margin-bottom: 1em;
    padding: 0.5em;
    width: 100%;
}

button {
    padding: 0.5em 1em;
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

footer {
    background-color: #f1f1f1;
    padding: 1em;
    text-align: center;
}

</style>
    <main>
        <section class="profile-picture">
            <img src="default-profile.png" alt="Profile Picture">
            <input type="file" id="profile-picture-upload">
        </section>
        
        <section class="personal-info">
            <h2>Personal Information</h2>
            <form id="profile-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">
                
                <button type="submit">Save Changes</button>
            </form>
        </section>
        
        <section class="change-password">
            <h2>Change Password</h2>
            <form id="password-form">
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current-password" required>
                
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>
                
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                
                <button type="submit">Change Password</button>
            </form>
        </section>
        
        <section class="preferences">
            <h2>Preferences</h2>
            <form id="preferences-form">
                <label for="language">Language:</label>
                <select id="language" name="language">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <!-- Add more options as needed -->
                </select>
                
                <label for="notifications">Email Notifications:</label>
                <input type="checkbox" id="notifications" name="notifications">
                
                <button type="submit">Save Preferences</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Contact us at <a href="mailto:support@mywebsite.com">support@mywebsite.com</a></p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
    
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Handle profile picture upload
    document.getElementById('profile-picture-upload').addEventListener('change', function() {
        // Code to handle the profile picture upload
        // e.g., preview the image or send it to the server
    });

    // Handle profile form submission
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        event.preventDefault();
        // Code to handle form submission
        // e.g., validate and send the data to the server
    });

    // Handle password form submission
    document.getElementById('password-form').addEventListener('submit', function(event) {
        event.preventDefault();
        // Code to handle password change
    });

    // Handle preferences form submission
    document.getElementById('preferences-form').addEventListener('submit', function(event) {
        event.preventDefault();
        // Code to handle preferences update
    });
});

</script>