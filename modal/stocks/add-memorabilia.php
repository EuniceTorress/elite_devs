<div id="gradPicModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title col-7">Graduation Pictures Arrival</h5>
            <div class="col-2">
                <label for="rowCount">No. to input: </label>
                <input type="number" id="rowCount" value="1" min="1" onchange="generateRows()">
            </div>
            <button type="button" class="close" onclick="closeModal()">×</button>
        </div>

        <form id="gradPicForm">
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitModalForm">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const triggerElement = document.getElementById("openMemorabilia");
    triggerElement.addEventListener("click", openModal);

    const gradPicForm = document.getElementById("gradPicForm");
    gradPicForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        submitaddForm();
    });
});

function showAlert(message, type) {
    const alertDiv = document.getElementById("alertMessage");
    alertDiv.textContent = message;

    if (type === "success") {
        alertDiv.style.backgroundColor = "#d4edda"; 
        alertDiv.style.color = "#155724"; 
        alertDiv.style.border = "1px solid #c3e6cb"; 
    } else if (type === "error") {
        alertDiv.style.backgroundColor = "#f8d7da"; 
        alertDiv.style.color = "#721c24";
        alertDiv.style.border = "1px solid #f5c6cb"; 
    }

    alertDiv.style.display = "block"; 

    setTimeout(() => {
        alertDiv.style.display = "none";
    }, 1000);
}

function checkDuplicates() {
    const rowCount = parseInt(document.getElementById('rowCount').value);
    const nameMap = new Map();

    for (let i = 0; i < rowCount; i++) {
        const firstName = document.getElementById(`firstName${i}`).value.trim().toLowerCase();
        const middleName = document.getElementById(`middleName${i}`).value.trim().toLowerCase();
        const lastName = document.getElementById(`lastName${i}`).value.trim().toLowerCase();

        const primaryName = `${firstName} ${lastName}`;
        const hasMiddleName = middleName !== ""; 

        if (nameMap.has(primaryName)) {
            const duplicateRow = nameMap.get(primaryName);
            const otherMiddleName = document.getElementById(`middleName${duplicateRow}`).value.trim().toLowerCase();
            const bothHaveMiddle = hasMiddleName && otherMiddleName !== "";

            if (bothHaveMiddle || hasMiddleName || otherMiddleName) {
                const confirmation = confirm(`Duplicate name found with middle name discrepancy:\nRow ${duplicateRow + 1} and Row ${i + 1} both have "${firstName} ${lastName}". Do you want to proceed?`);
                if (!confirmation) {
                    return true;
                }
            } else {
                alert(`Duplicate name found:\nRow ${duplicateRow + 1} and Row ${i + 1} have the same first and last name: ${firstName} ${lastName}`);
                return true; 
            }
        }
        
        nameMap.set(primaryName, i);
    }

    return false; 
}

function submitaddForm() {
    if (checkDuplicates()) {
        return; 
    }

    const rowCount = parseInt(document.getElementById('rowCount').value);
    const rows = [];

    for (let i = 0; i < rowCount; i++) {
        rows.push({
            firstName: document.getElementById(`firstName${i}`).value,
            middleName: document.getElementById(`middleName${i}`).value || null,
            lastName: document.getElementById(`lastName${i}`).value,
            suffix: document.getElementById(`suffix${i}`).value || null,
            program: document.getElementById(`program${i}`).value,
            month: parseInt(document.getElementById(`month${i}`).value),
            day: parseInt(document.getElementById(`day${i}`).value)
        });
    }

    console.log("Submitting form with rows:", rows); 

    fetch('../../sql/insert/add-memorabilia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ rows })
    })
    .then(response => response.text()) 
    .then(text => {
        console.log("Raw response text:", text);
        const result = JSON.parse(text);
        console.log("Parsed response:", result);
        if (result.status === 'success') {
            alert("Form submitted successfully!");
            closeModal();
        } else {
            alert("Error submitting form: " + result.error);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('Error submitting form');
    });
}


function openModal() {
    const modal = document.getElementById('gradPicModal');
    modal.classList.add('show');
    generateRows();
}

function closeModal() {
    const modal = document.getElementById('gradPicModal');
    modal.classList.remove('show');
}


function generateRows() {
    const rowCount = parseInt(document.getElementById('rowCount').value);
    const modalBody = document.getElementById('modalBody');
    
    const existingData = [];
    for (let i = 0; i < modalBody.children.length; i++) {
        existingData.push({
            firstName: document.getElementById(`firstName${i}`)?.value || "",
            middleName: document.getElementById(`middleName${i}`)?.value || "",
            lastName: document.getElementById(`lastName${i}`)?.value || "",
            suffix: document.getElementById(`suffix${i}`)?.value || "",
            program: document.getElementById(`program${i}`)?.value || "",  
            month: document.getElementById(`month${i}`)?.value || "",
            day: document.getElementById(`day${i}`)?.value || ""
        });
    }

    modalBody.innerHTML = ''; 

    const today = new Date();
    const currentMonth = today.getMonth() + 1;
    const currentDay = today.getDate();

    for (let i = 0; i < rowCount; i++) {
        const row = document.createElement('div');
        row.classList.add('form-row');
        
        row.innerHTML = `
            <p class="pt-4">${i + 1}. </p>
            <div class="form-group col-2">
                <label for="firstName${i}">First Name</label>
                <input type="text" class="form-control" id="firstName${i}" name="firstName${i}" required>
            </div>
            <div class="form-group col-2">
                <label for="middleName${i}">Middle Name</label>
                <input type="text" class="form-control" id="middleName${i}" name="middleName${i}" placeholder="Optional">
            </div>
            <div class="form-group col-2">
                <label for="lastName${i}">Last Name</label>
                <input type="text" class="form-control" id="lastName${i}" name="lastName${i}" required>
            </div>
            <div class="form-group col-1">
                <label for="suffix${i}">Suffix</label>
                <input type="text" class="form-control" id="suffix${i}" name="suffix${i}" placeholder="Optional">
            </div>
            <div class="form-group col-2">
                <label for="program${i}">Program</label>
                <select class="form-control" id="program${i}" name="program${i}" required>
                    <option value="">Select Program</option>
                </select>
            </div>
            <div class="form-group col-1">
                <label for="month${i}">Month</label>
                <select class="form-control" id="month${i}" name="month${i}" required>
                    ${[...Array(12).keys()].map(j => `<option value="${j+1}" ${currentMonth === j+1 ? 'selected' : ''}>${new Date(0, j).toLocaleString('default', { month: 'long' })}</option>`).join('')}
                </select>
            </div>
            <div class="form-group col-1">
                <label for="day${i}">Day</label>
                <input type="number" class="form-control" id="day${i}" name="day${i}" min="1" max="31" required value="${currentDay}">
            </div>
        `;

        modalBody.appendChild(row);
    }

    existingData.forEach((data, i) => {
        if (i < rowCount) {
            document.getElementById(`firstName${i}`).value = data.firstName;
            document.getElementById(`middleName${i}`).value = data.middleName;
            document.getElementById(`lastName${i}`).value = data.lastName;
            document.getElementById(`suffix${i}`).value = data.suffix;
            document.getElementById(`month${i}`).value = data.month;
            document.getElementById(`day${i}`).value = data.day;
            document.getElementById(`program${i}`).value = data.program; 
        }
    });

    fetchPrograms(existingData);
}

function fetchPrograms(existingData) {
    fetch('../../sql/fetch/student-program.php')
        .then(response => response.json())
        .then(programs => {
            existingData.forEach((data, i) => {
                const select = document.getElementById(`program${i}`);
                programs.forEach(program => {
                    const programGroup = document.createElement('optgroup');
                    programGroup.label = program.program;

                    program.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course;
                        option.textContent = course;
                        programGroup.appendChild(option);
                    });

                    select.appendChild(programGroup);
                });

            });
        })
        .catch(error => console.error('Error fetching programs:', error));
}


function fetchPrograms() {
    fetch('../../sql/fetch/student-program.php')
        .then(response => response.json())
        .then(programs => {
            const programSelects = document.querySelectorAll('select[id^="program"]');
            programSelects.forEach(select => {
                programs.forEach(program => {
                    const programGroup = document.createElement('optgroup');
                    programGroup.label = program.program;

                    program.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course;
                        option.textContent = course;
                        programGroup.appendChild(option);
                    });

                    select.appendChild(programGroup);
                    
                });
            });
        })
        .catch(error => console.error('Error fetching programs:', error));
}

</script>
