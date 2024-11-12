<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .accset {
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
        }

        #fileInput {
            display: none;
        }

        .custom-file-label {      
            background-color: rgb(184, 0, 0);
            color: rgb(255, 255, 255);
            font-size: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .sidebar {
            width: 250px;
            background-color: #f7f9fc;
            text-align: center;
        }

        .sidebar img {
            object-fit: cover;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar .bt a {
            color: red;
            text-align: center;
        }

        .sidebar .bt a i {
            color: rgb(0, 0, 0);
        }

        .form-section {
            flex: 1;
        }

        .form-section .hm a {
            text-decoration: none;
            color: black;
            font-size: 25px;
        }

        .cpass {
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .acclogs {
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .acclogs button a {
            text-decoration: none;
        }

        #fileInput {
            display: none;
        }
    </style>
</head>

<body>

    <div class="account-settings-container p-4">
        <div class="container p-0 accset">
            <div class="sidebar d-flex justify-content-between flex-column py-5 p-2">
                <div>
                    <img src="./img/1e99fbaeb36fc3a43d504986f781aeed.jpg" alt="Profile Picture">
                    <h5>Ryan Gosling</h5>
                    <label for="fileInput" class="custom-file-label p-1">Upload Photo <i class="material-icons">upload</i></label>
                    <input type="file" id="fileInput">
                </div>
                <div class="bt">
                    <a href="">Sign Out <i class="material-icons">exit_to_app</i></a>
                </div>
            </div>
            <div class="form-section p-4">
                <div class="text-end hm">
                    <a href="homepage.html"><i class="material-icons">home</i></a>
                </div>
                <h3>Account Settings <i class="material-icons">settings</i></h3>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="Denver">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="Hakdog">
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="Jhakdogz">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" value="******">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" value="Jden76@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone number</label>
                            <input type="tel" class="form-control" id="phone" value="+63-904-857-2345">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-outline-primary">Save</button>
                            <button type="button" class="btn btn-outline-danger ms-auto">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="cp">
        <div class="container cpass p-4">
            <h4>Change Password <i class="material-icons">lock</i></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, dolor necessitatibus, fuga alias obcaecati
                ad unde delectus et expedita earum quas omnis hic minus illo architecto facilis, perspiciatis
                praesentium molestiae.</p>
            <div class="d-grid">
                <button type="button" class="btn btn-outline-primary">Change Password</button>
            </div>
        </div>
    </div>
    <div class="Aclog p-3">
        <div class="container acclogs p-4">
            <h4>Activities <i class="material-icons">access_time</i></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, dolor necessitatibus, fuga alias obcaecati
                ad unde delectus et expedita earum quas omnis hic minus illo architecto facilis, perspiciatis
                praesentium molestiae.</p>
            <div class="d-grid">
                <button type="button" class="btn btn-outline-primary"><a href="activitylog.html">Activity
                        logs</a></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
