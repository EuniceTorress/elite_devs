<style>
#verification-fb {
    width: 30%;
}

label {
    display: block;
    margin-bottom: 5px;
}

button {
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 0.8rem;
}

#sendCodeButton:hover,
button[type="submit"]:hover {
    background-color: black;
}

#sendCodeButton {
    background-color: #4CAF50;
    color: white;
    width: auto; 
    margin-top: 0;
}

#sendCodeButton:disabled {
    background-color: #4CAF50;
}

button[type="submit"] {
    background-color: maroon;
    color: white;
    width: 100%;
    margin-top: 0;
}

button[type="submit"]:disabled {
    background-color: maroon;
}

button:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

#rgstr-ctr {
    display: flex;
    justify-content: center;
    padding: 20px;
}

.input-group.email,
.input-group.code {
    display: flex;
    align-items: center;
    width: 100%; 
    margin-bottom: 15px;
}

.input-group.email input {
    flex: 1; 
    margin-right: 10px;
}

.input-group.code input {
    flex: 2;
}

#timer-container {
    display: none; 
    align-items: center;
    width: 100%;
    justify-content: center; 
    margin-top: 0;
}

#timer {
    font-size: 0.8rem;
    padding: 5px;
    text-align: center;
    margin-top: 0;
}

#loading-message {
    font-size: 0.8rem;
    color: #ff6600;
    display: none;
    margin-bottom: 20px;
    text-align: center;
}

#verificationCode:disabled,
.input-group.email input:disabled {
    opacity: 0.3;
}
</style>

<div class="form-box" id="verification-fb">
    <h2>SIGN UP</h2>
    <form class="verification-form" id="verification-form" onsubmit="return verifyCode(event)">
        <div class="input-group email" id="emailrow">
            <input type="email" id="email" name="email" placeholder="Enter your email" required pattern=".+@.+" title="Please include an '@' in the email address">
            <button type="button" id="sendCodeButton" onclick="sendVerificationCode()">Send Code</button>
        </div>
        <div id="timer-container">
            <p id="timer">Code sent successfuly! Resend code after <span id="countdown">03:00</span></p>
        </div>
        <div id="loading-message">Processing...</div>
        <div class="input-group code">
            <input type="text" id="verificationCode" name="verificationCode" placeholder="Verification Code" required maxlength="6" disabled oninput="validateCodeInput(this)">
        </div>
        <div id="display_error" style="color: red; margin-top: 20px; margin-bottom: 20px; font-size: 0.8rem"></div>
        <button type="submit" id="submit-button" disabled>Submit</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
let timer;
let countdownElement = document.getElementById('countdown');
let sendCodeButton = document.getElementById('sendCodeButton');
let submitButton = document.getElementById('submit-button');
let verificationCodeInput = document.getElementById('verificationCode');
let loadingMessage = document.getElementById('loading-message');
let displayError = document.getElementById('display_error');
let timerContainer = document.getElementById('timer-container');
let emailInput = document.getElementById('email');

window.onload = function() {
    emailInput.value = '';
    verificationCodeInput.value = '';
    submitButton.disabled = true;
    verificationCodeInput.disabled = true;
    sendCodeButton.disabled = false;
};

verificationCodeInput.addEventListener('input', function() {
    submitButton.disabled = verificationCodeInput.value.length === 0;
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
        url: "send-code.php",
        data: { email_account: email },
        dataType: "json",
        success: function (response) {
            loadingMessage.style.display = 'none';
            if (response.error1 === 'success') {
                startTimer(180);
                timerContainer.style.display = 'flex';
                verificationCodeInput.disabled = false;
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

    seconds = seconds < 10 ? '0' + seconds : seconds;
    countdownElement.textContent = `${minutes}:${seconds}`;
}

function validateCodeInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '').slice(0, 6);
}

function verifyCode(event) {
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
        url: "verification.php",
        data: { email_account: email, verification_code: code },
        dataType: "json",
        success: function (response) {
            if (response.error2 === 'success') {
                displayError.textContent = 'Code verified successfully!';
                window.location.href = 'forms.php?type=form-register2';
            } else {
                displayError.textContent = 'Invalid code or code expired.';
            }
        },
        error: function () {
            displayError.textContent = 'Failed to verify the code. Please try again later.';
        }
    });

    return false;
}

</script>
