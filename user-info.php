   <style>
        #ui-ctr {
            width: 80%;
            height: 90vh;
            overflow-y: auto;
            margin: auto;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .row .input-group {
            flex: 1;
        }

        .row-inline {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .row-inline .input-group {
            flex: 1;
        }

        .additional-info {
            display: none;
            flex: 1;
            margin-bottom: 15px;
        }

        .additional-info .input-group {
            margin-bottom: 0;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
            width: 20%;
        }

        button[type="submit"] {
            background-color: #008CBA;
            color: white;
        }

        button[type="button"]:hover {
            opacity: 0.8;
        }

        button[type="submit"]:hover:disabled {
            background-color: #008CBA;
        }

        #commonFields, #studentFields, #guestFields, #rgoStaffFields {
            display: none;
        }

        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>
    <div class="container" id="ui-ctr">
        <div class="form-box" id="ui-fb">
            <h2>SIGN UP</h2>
            <form id="user-info-form" action="sql/insert/user-info.php" method="post">
                <div class="input-group">
                    <select id="role" name="role" onchange="updateForm()" required>
                        <option value="">Select a role</option>
                        <option value="rgoStaff">RGO Staff</option>
                        <option value="student">Student</option>
                        <option value="facilitator">Facilitator</option>
                        <option value="guest">Guest</option>
                    </select>
                </div>

                <div id="commonFields">
                    <div class="row">
                        <div class="input-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="input-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" id="middleName" name="middleName" placeholder="Optional">
                        </div>
                        <div class="input-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                        <div class="input-group">
                            <label for="suffix">Suffix:</label>
                            <input type="text" id="suffix" name="suffix" placeholder="Optional">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="tel" id="contactNumber" name="contactNumber" required oninput="validateContactNumberInput(this)" maxlength="11" pattern="\d*">
                        </div>
                        <div class="input-group">
                            <label for="birthdate">Birthdate:</label>
                            <input type="date" id="birthdate" name="birthdate" required>
                            <div id="birthdateError" class="error-message"></div>
                        </div>
                    </div>

                    <div id="guestFields">
                        <div class="row-inline">
                            <div class="input-group">
                                <label for="purpose">Purpose:</label>
                                <select id="purpose" name="purpose" onchange="toggleAdditionalInfo('purpose', 'purposeOther')" required>
                                    <option value="">Select purpose</option>
                                    <option value="meeting">Meeting</option>
                                    <option value="event">Event</option>
                                    <option value="research">Research</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div id="purposeOther" class="additional-info">
                                <div class="input-group">
                                    <label for="purposeOtherInput">Please specify:</label>
                                    <input type="text" id="purposeOtherInput" name="purposeOtherInput">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="facilitatorFields">
                        <div class="row-inline">
                            <div class="input-group">
                                <label for="department">Department:</label>
                                <select id="department" name="department" required>
                                    <option value="">Select a department</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="studentFields">
                        <div class="row">
                            <div class="input-group">
                                <label for="srCode">SR-Code:</label>
                                <input type="text" id="srCode" name="srCode" required oninput="formatSRCode(this)" maxlength="8" pattern="\d{2}-\d{5}">
                            </div>
                            <div class="input-group">
                                <label for="program">Program:</label>
                                <select id="program" name="program" required></select>
                            </div>
                            <div class="input-group">
                                <label for="course">Course:</label>
                                <select id="course" name="course" required></select>
                            </div>
                        </div>
                    </div>

                    <div id="rgoStaffFields">
                        <div class="row-inline">
                            <div class="input-group">
                                <label for="position">Position:</label>
                                <select id="position" name="position" onchange="toggleAdditionalInfo('position', 'positionOther')" required>
                                    <option value="">Select a position</option>
                                    <option value="manager">Manager</option>
                                    <option value="staff">Staff</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div id="positionOther" class="additional-info">
                                <div class="input-group">
                                    <label for="positionOtherInput">Please specify:</label>
                                    <input type="text" id="positionOtherInput" name="positionOtherInput">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required oninput="validateUsername()">
                            <div id="usernameError" class="error-message"></div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required oninput="validateForm()">
                            <div id="passwordError" class="error-message"></div>
                        </div>
                    </div>
                </div>

                <div id="errorMessages">
                    <ul id="errorList"></ul>
                </div>

                <div class="buttons">
                    <button type="button" onclick="goBack()">Back</button>
                    <button type="submit" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let hasErrors = true; 

    function updateForm() {
        const role = document.getElementById('role').value;
        const commonFields = document.getElementById('commonFields');
        const studentFields = document.getElementById('studentFields');
        const rgoStaffFields = document.getElementById('rgoStaffFields');
        const guestFields = document.getElementById('guestFields');
        const facilitatorFields = document.getElementById('facilitatorFields');
        const submitButton = document.querySelector('button[type="submit"]');
        const programSelect = document.getElementById('program');
        const departmentSelect = document.getElementById('department');

        studentFields.style.display = 'none';
        guestFields.style.display = 'none';
        rgoStaffFields.style.display = 'none';
        facilitatorFields.style.display = 'none';

        if (!role) {
            commonFields.style.display = 'none';
            submitButton.disabled = true;
        } else {
            commonFields.style.display = 'block';

            if (role === 'student') {
                studentFields.style.display = 'block';
                populatePrograms();
            } else if (role === 'guest') {
                guestFields.style.display = 'block';
            } else if (role === 'rgoStaff') {
                rgoStaffFields.style.display = 'block';
            } else if (role === 'facilitator') {
                facilitatorFields.style.display = 'block';
                populateDepartments();
            }

            checkSubmitButton(); 
        }
    }

    function formatSRCode(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 2) {
            value = value.slice(0, 2) + '-' + value.slice(2);
        }

        input.value = value;
    }

    function populateDepartments() {
        const departmentSelect = document.getElementById('department');

        departmentSelect.innerHTML = '<option value="">Loading...</option>';

        fetch('sql/departments.php') 
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                departmentSelect.innerHTML = '<option value="">Select Department</option>';

                data.forEach(department => {
                    const departmentOption = document.createElement('option');
                    departmentOption.value = department; 
                    departmentOption.textContent = department;
                    departmentSelect.appendChild(departmentOption);
                });
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
                departmentSelect.innerHTML = '<option value="">Failed to load departments</option>';
            });
    }

    function populatePrograms() {
    const programSelect = document.getElementById('program');
    const courseSelect = document.getElementById('course'); 

    programSelect.innerHTML = '<option value="">Loading...</option>';
    courseSelect.innerHTML = '<option value="">Select Course</option>';

    fetch('sql/programs.php')
        .then(response => response.json())
        .then(data => {
            programSelect.innerHTML = '<option value="">Select Program</option>';

            Object.keys(data).forEach(identifier => {
                const program = data[identifier].program;

                const programOption = document.createElement('option');
                programOption.value = identifier; 
                programOption.textContent = program;
                programSelect.appendChild(programOption);
            });

            programSelect.addEventListener('change', function () {
                const selectedProgram = this.value; 

                courseSelect.innerHTML = '<option value="">Select Course</option>';

                if (selectedProgram && data[selectedProgram]) {
                    data[selectedProgram].courses.forEach(course => {
                        const courseOption = document.createElement('option');
                        courseOption.value = course;
                        courseOption.textContent = course;
                        courseSelect.appendChild(courseOption);
                    });
                }
            });
        })
        .catch(error => {
            console.error('Error fetching programs:', error);
            programSelect.innerHTML = '<option value="">Failed to load programs</option>';
            courseSelect.innerHTML = '<option value="">Failed to load courses</option>';
        });
    }

    function toggleAdditionalInfo(selectId, additionalId) {
        const selectElement = document.getElementById(selectId);
        const additionalElement = document.getElementById(additionalId);
        additionalElement.style.display = selectElement.value === 'other' ? 'flex' : 'none';
    }

    function validateUsername() {
        const username = document.getElementById('username').value;
        const usernameError = document.getElementById('usernameError');
        const submitButton = document.querySelector('button[type="submit"]');

        if (username.length > 0) {
            fetch('sql/username-validation.php?username=' + encodeURIComponent(username))
                .then(response => response.text())
                .then(text => {
                    if (text === 'taken') {
                        usernameError.textContent = 'Username is already taken.';
                        usernameError.style.display = 'block';
                        hasErrors = true;
                    } else {
                        usernameError.textContent = '';
                        usernameError.style.display = 'none';
                        hasErrors = false;
                    }
                    checkSubmitButton();
                });
        } else {
            usernameError.textContent = '';
            usernameError.style.display = 'none';
            hasErrors = true;
            checkSubmitButton();
        }
    }
    
    function validateForm() {
        const password = document.getElementById('password').value;
        const passwordError = document.getElementById('passwordError');
        const submitButton = document.querySelector('button[type="submit"]');
        let errors = false;

        if (password.length > 0 && password.length < 8) {
            errors = true;
            passwordError.textContent = 'Password must be at least 8 characters long.';
            passwordError.style.display = 'block';
        } else if (password.length > 0 && !/\d/.test(password)) {
            errors = true;
            passwordError.textContent = 'Password must contain at least one number.';
            passwordError.style.display = 'block';
        } else {
            passwordError.textContent = '';
            passwordError.style.display = 'none';
        }

        hasErrors = errors; 
        checkSubmitButton();
        return !errors;
    }

    function checkSubmitButton() {
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.disabled = hasErrors;
    }

    document.getElementById('user-info-form').addEventListener('submit', function (event) {
        event.preventDefault();  

        if (hasErrors) {
            return;  
        }

        const formData = new FormData(this);  

        fetch('sql/insert/user-info.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            const errorList = document.getElementById('errorList');
            errorList.innerHTML = '';

            if (result.success) {
                alert('Registration successful!');
                window.location.href = 'forms.php?type=form-login'; 
            } else {
                result.errors.forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = error;
                    errorList.appendChild(li); 
                });
            }
        })
        .catch(error => {
            console.error('Error:', error); 
        });
    });

    document.getElementById('username').addEventListener('input', function () {
        validateUsername();
    });

    function validateContactNumberInput(input) {
        input.value = input.value.replace(/\D/g, '');
    }

    function goBack() {
        window.history.back();
    }
    </script>