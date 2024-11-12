<h2 class="text-center mb-4">LOGIN</h2>
<form class="p-2">
    <div class="mb-4 position-relative">
        <label for="username" class="form-label"><span class="material-icons">person</span></label>
        <input type="username" class="form-control" id="username" placeholder="Username" aria-describedby="emailHelp">
    </div>
    <div class="mb-4 position-relative">
        <label for="password" class="form-label lock-icon"><span class="material-icons">lock</span>
        </label>
        <div class="input-container">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <span class="material-icons text-align-right eye-container" id="togglePassword">visibility</span>
        </div>
        <div id="emailHelp" class="form-text p-3 text-end">
            <a type="button" href="forms.php?3">Forgot Password?</a>
        </div>
    </div>
    <div class="d-grid text-center">
        <div id="display_error" style="font-size: 0.8rem; color: red; margin-bottom: 10px; margin-top: -40px;"></div>
        <button type="submit" class="btn" id="login-button">Login</button>
        <div id="sign-up" class="form-text p-3">Doesn't have an account?
        <a href="forms.php?2">Sign Up</a></div>
    </div>
</form>
        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    togglePassword.textContent = type === 'password' ? 'visibility' : 'visibility_off';
    
    togglePassword.classList.toggle('visible', type === 'text');
});


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
                url: "../sql/index/login-validation.php", 
                data: { username: username, password: password },
                dataType: "json",
                success: function(response) {
                    if (response.includes('success')) {
                        $('#login-button').prop('disabled', true);
                        $("#display_error").html("Login Successful!").show();
                        setTimeout(function () {
                            window.location.href = '../panel/body/body.php?dashboard';
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