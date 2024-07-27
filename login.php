<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .login-container {
        background: linear-gradient(10deg, #000000 10%, #800000 74%);
        padding: 30px 20px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 400px;
        margin: auto;
    }

    .login-form {
        max-width: 100%;
        width: 100%;
        text-align: center;
    }

    .login-form h2 {
        margin-bottom: 25px;
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .input-container {
        position: relative;
        margin-bottom: 25px;
    }

    .input-container input {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background-color: #FFFFFF;
        color: #000000;
        font-size: 16px;
        transition: background-color 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .input-container input::placeholder {
        opacity: 0.7;
        color: #800000;
    }

    .input-container input:focus {
        outline: none;
        background-color: #f7f7f7;
    }

    .login-form button {
        width: 100%;
        padding: 12px;
        background-color: #800000;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-form button:hover {
        background-color: white;
        color: #800000;
    }

    .login-form .input-container i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #800000;
    }

    .login-form .input-container .fa-user {
        left: 10px;
        font-size: 20px;
    }

    .login-form .input-container .fa-lock {
        right: 10px;
        font-size: 20px;
    }

    @media (max-width: 768px) {
        .login-container {
            padding: 20px;
        }

        .login-form h2 {
            font-size: 20px;
        }

        .login-form button {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 15px;
        }

        .login-form h2 {
            font-size: 18px;
        }

        .login-form button {
            font-size: 14px;
        }
    }

    .lgn-ctr {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>
<div class="container-fluid lgn-ctr">
    <div class="login-container">
        <form class="login-form" id="login-form">
            <h2>LOGIN</h2>
            <div class="input-container username">
                <i class="far fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="26" required>
            </div>
            <div class="input-container password">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="26" required>
                <i class="fas fa-eye" id="toggle-password" style="cursor: pointer; position: absolute; right: 40px; top: 50%; transform: translateY(-50%); opacity:0.5;"></i>
            </div>
            <div id="display_error" style="color: red; margin-top: 5px; margin-bottom: 5px"></div>
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function checkFields() {
            var username = $('#username').val();
            var password = $('#password').val();

            if (username.length > 0 && password.length > 0) {
                $('#login-button').prop('disabled', false);
            } else {
                $('#login-button').prop('disabled', true);
            }
        }

        $('#username, #password').on('input', checkFields);

        checkFields();

        $("#login-button").on("click", function(event) {
            event.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                type: "POST",
                url: "sql/login-validation.php", 
                data: { username: username, password: password },
                dataType: "json",
                success: function(response) {
                    if (response === 'success') {
                        $('#login-button').prop('disabled', true);
                        $("#display_error").html("Login Successful!").show();
                        setTimeout(function () {
                            window.location.href = 'panel/user-homepage.php';
                        }, 600);
                    } else {
                        $('#login-button').prop('disabled', false);
                        $("#display_error").html(response).show();
                        $("#password").val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#login-button').prop('disabled', false);
                    $("#display_error").html("An error occurred. Please try again.").show();
                }
            });
        });

        $("#toggle-password").on("click", function() {
            var passwordField = $("#password");
            var type = passwordField.attr("type") === "password" ? "text" : "password";
            passwordField.attr("type", type);
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
</script>
