<h2 class="text-center mb-4">SIGN UP</h2>
<form class="p-2" onsubmit="return verifyCode(event);">
    <div class="mb-4 position-relative">
        <label for="email" class="form-label"><span class="material-icons">email</span></label>
        <a type="button" id="sendCodeButton" onclick="sendVerificationCode()">Send Code</a>
        <input type="email" class="form-control" id="email" placeholder="Email" aria-describedby="emailHelp">
    </div>
    
    <div class="mb-4 position-relative" style="margin-top: 30px;">
        <label for="verificationCode" class="form-label">
            <span class="material-icons">confirmation_number</span>
        </label>
        <input type="text" class="form-control" id="verificationCode" placeholder="Enter Verification Code" oninput="validateCodeInput(this)">
    </div>
    <div class="d-grid text-center">
        <div id="timer-container">
            <p id="timer">Resend code after <span id="countdown">03:00</span></p>
        </div>
        <div id="loading-message">Processing...</div>
        <div id="display_error" style="color: red; margin-top: -10px; margin-bottom: 20px; font-size: 0.8rem"></div>
        <button type="submit" class="btn" id="verify-btn" disabled>Verify</button>
        <div id="emailHelp" class="form-text p-3">
            Already have an account? <a href="forms.php?1">Login</a>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
let timer;
let countdownElement = document.getElementById('countdown');
let sendCodeButton = document.getElementById('sendCodeButton');
let verifyButton = document.getElementById('verify-btn');
let verificationCodeInput = document.getElementById('verificationCode');
let loadingMessage = document.getElementById('loading-message');
let displayError = document.getElementById('display_error');
let timerContainer = document.getElementById('timer-container');
let emailInput = document.getElementById('email');

window.onload = function() {
    emailInput.value = '';
    verificationCodeInput.value = '';
    verifyButton.disabled = true;
    verificationCodeInput.disabled = true;
    sendCodeButton.disabled = false;
};

verificationCodeInput.addEventListener('input', function() {
    verifyButton.disabled = verificationCodeInput.value.length === 0;
});

function sendVerificationCode() {
    let email = emailInput.value;
    displayError.textContent = '';

    if (!email.includes('@')) {
        displayError.textContent = 'Please enter a valid email with "@" symbol.';
        return;
    }

    sendCodeButton.disabled = true;
    emailInput.disabled = true;
    verificationCodeInput.disabled = true;
    loadingMessage.style.display = 'block';

    $.ajax({
        type: "POST",
        url: "../sql/index/send-code.php",
        data: { email_account: email },
        dataType: "json",
        success: function (response) {
            loadingMessage.style.display = 'none';
            if (response.error1 === 'success') {
                displayError.textContent = 'Code sent successfully!';
                displayError.style.color = 'green';
                setTimeout(function() {
                startTimer(180);
                timerContainer.style.display = 'block';
                verificationCodeInput.disabled = false;
                displayError.textContent = '';
                }, 1000);
            } else {
                sendCodeButton.disabled = false;
                emailInput.value = '';
                emailInput.disabled = false; 
                displayError.textContent = response.error1;
            }
        },
        error: function () {
            loadingMessage.style.display = 'none';
            sendCodeButton.disabled = false;
            emailInput.disabled = false; 
            displayError.textContent = 'Failed to send verification code. Please try again later.';
        }
    });
}

function startTimer(duration) {
    clearInterval(timer);
    let timeRemaining = duration;
    updateTimer(timeRemaining);

    timer = setInterval(() => {
        timeRemaining--;
        updateTimer(timeRemaining);

        if (timeRemaining <= 0) {
            clearInterval(timer);
            sendCodeButton.disabled = false;
            sendCodeButton.textContent = 'Resend Code';
            timerContainer.style.display = 'none';
        }
    }, 1000);
}

function updateTimer(timeRemaining) {
    let minutes = Math.floor(timeRemaining / 60);
    let seconds = timeRemaining % 60;
    countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function validateCodeInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '').slice(0, 6);
}

function verifyCode(event) {
    sendCodeButton.disabled = true;
    event.preventDefault();
    displayError.textContent = '';

    let email = emailInput.value;
    let code = verificationCodeInput.value;

    if (!code) {
        displayError.textContent = 'Please enter the verification code.';
        return false;
    }

    $.ajax({
        type: "POST",
        url: "../sql/index/verification.php",
        data: { email_account: email, verification_code: code },
        dataType: "json",
        success: function (response) {
            if (response.error2 === 'success') {
                displayError.textContent = 'Code verified successfully!';
                displayError.style.color = 'green';
                setTimeout(function() {
                    window.location.href = 'forms.php?3';
                }, 2000);
            } else {
                displayError.textContent = 'Invalid code or code expired.';
                displayError.style.color = 'red';
            }
        },
        error: function () {
            displayError.textContent = 'Failed to verify the code. Please try again later.';
        }
    });

    return false;
}
</script>
