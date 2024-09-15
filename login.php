<style>
    .lgn-ctr {
        justify-content: center;
        align-items: center;
        align-content: center;
        text-align: center;
        margin: 0;
        padding: 0;
        width: 30%;
    }

    .input-group {
        position: relative;
    }

.input-group i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #800000;
    font-size: 1rem;
    transition: color 0.3s ease, border 0.3s ease;
}

.input-group.username i {
    left: 20px;
}

.input-group.password i {
    left: 20px;
}

.input-group.password i:last-of-type {
    right: 20px;
    left: auto;
}

.input-group.password i:last-of-type:hover {
    color: #1f1f1f;
}


#rgtrbtn {
    font-size: 0.9rem;
    color: blue;
}

#rgtrbtn:hover {
    color: black;
}

</style>
<div class="container lgn-ctr">
    <div class="form-box" id="login-fb">
        <h2>LOGIN</h2>
        <form class="login-form" id="login-form">
            <div class="input-group username">
                <i class="far fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="26" required>
            </div>
            <div class="input-group password">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="26" required>
                <i class="fas fa-eye" id="toggle-password" style="cursor: pointer; opacity: 0.5;"></i>
            </div>
            <div id="display_error" style="font-size: 0.8rem; color: red; margin-bottom: 5px"></div>
            <span style="font-size: 0.9rem;">Doesn't have an account ?
            <a type="button" class="btn" id="rgtrbtn" href="forms.php?type=form-register1">Register Now!</a>
            </span>
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
                    if (response.includes('success')) {
                        $('#login-button').prop('disabled', true);
                        $("#display_error").html("Login Successful!").show();
                        setTimeout(function () {
                            window.location.href = 'panel/user-homepage.php?type=dashboard';
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
