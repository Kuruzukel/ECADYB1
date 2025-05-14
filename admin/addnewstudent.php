<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Details</title>
    <style>
    .container {
        height: 100%;
        background-color: var(--content-bg);
        border-radius: 10px 10px 0 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .header-container {
        width: 100%;
        height: 70px;
        background-color: #0928c6;
        padding: 20px;
        border-radius: 8px 8px 0 0;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 2px solid #fcda15;
    }

    h1 {
        margin: 0;
        color: #ffffff;
        font-size: 24px;
    }

    .form-content {
        padding: 25px;
        box-sizing: border-box;
    }

    .form-group {
        display: flex;
        justify-content: space-between;
        gap: 25px;
    }

    .section {
        width: 32%;
        min-width: 250px;
        background-color: #34495e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        min-height: 480px;
        display: flex;
        flex-direction: column;
    }

    .section-header {
        width: calc(100% + 40px);
        height: 50px;
        background-color: #217ff7;
        color: white;
        padding: 12px;
        margin: -20px -20px 20px -20px;
        border-radius: 8px 8px 0 0;
        text-align: center;
        font-size: 1.1em;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    label {
        display: block;
        margin: 12px 0 6px;
        color: #e0e0e0;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #f0f0f0;
        margin-bottom: 12px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .submit-btn {
        width: 200px;
        height: 45px;
        display: block;
        margin: 25px auto 0;
        padding: 12px 25px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    @media (max-width: 768px) {
        .form-group {
            flex-direction: column;
        }

        .section {
            width: 100%;
            margin-bottom: 20px;
        }
    }

    /* MODAL STYLES */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal {
        background-color: #fff;
        color: #000;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
    }

    .modal h2 {
        margin-top: 0;
        font-size: 1.4rem;
    }

    .modal-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
    }

    .modal-btn {
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .confirm {
        background-color: #4caf50;
        color: white;
    }

    .cancel {
        background-color: #e74c3c;
        color: white;
    }

    .modal-btn:hover {
        opacity: 0.9;
    }
    </style>
</head>

<body>
    <div class="container" style="font-family: Arial, sans-serif;">
        <div class="header-container" style="width: 100%;">
            <h1>Add Student Details</h1>
        </div>
        <div class="form-content" style="width: 100%;">
            <div class="form-group">
                <div class="section">
                    <div class="section-header">Personal Information</div>

                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" placeholder="First Name" oninput="allowOnlyLetters(this)">

                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" placeholder="Middle Name" oninput="allowOnlyLetters(this)">

                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" placeholder="Last Name" oninput="allowOnlyLetters(this)">

                </div>

                <div class="section">
                    <div class="section-header">Academic Information</div>

                    <label for="academic-year">Academic Year:</label>
                    <select id="academic-year">
                        <option value="" disabled selected>Select Aacademic Year</option>
                        <option value="2023-2024">2023-2024</option>
                        <option value="2024-2025">2024-2025</option>
                    </select>


                    <label for="program">Program:</label>
                    <select id="program">
                        <option value="" disabled selected>Select a program</option>
                        <option value="Maritime Education">Maritime Education</option>
                        <option value="Criminology">Criminology</option>
                        <option value="Tourism Managements">Tourism Management</option>
                        <option value="College of Education">College of Education</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Information System">Information System</option>
                        <option value="Business Administration">Business Administration</option>
                    </select>


                    <label for="section">Section:</label>
                    <input type="text" id="section" placeholder="Section" oninput="allowOnlyLetters(this)">

                    <label for="section">Student ID:</label>
                    <input type="text" id="academic-year" placeholder="2024-000000" maxlength="11"
                        oninput="formatStudentID(this)">

                </div>

                <div class="section">
                    <div class="section-header">Additional Information</div>
                    <label for="personal-philosophy">Personal Philosophy:</label>
                    <input type="text" id="personal-philosopjy" placeholder="Personal Philosophy">

                    <label for="latin-awards">Latin Awards:</label>
                    <input type="text" id="latin-awards" placeholder="Latin Awards" oninput="allowOnlyLetters(this)">

                    <label for="career-highlights">Career Highlights:</label>
                    <input type="text" id="career-highlights" placeholder="Career Highlights"
                        oninput="allowOnlyLetters(this)">

                </div>
            </div>
            <button class="submit-btn" id="add-student-btn">Add Student</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal" style="font-family: Arial, sans-serif;">
            <h2>Are you sure you want to add this student?</h2>
            <div class="modal-buttons">
                <button class="modal-btn confirm" id="confirm-btn">Yes, Add</button>
                <button class="modal-btn cancel" id="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    function allowOnlyLetters(input) {
        const sanitized = input.value.replace(/[^a-zA-Z\s]/g, '');
        if (input.value !== sanitized) {
            input.value = sanitized;
        }
    }

    function formatStudentID(input) {
        let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
        if (value.length > 4) {
            value = value.slice(0, 4) + '-' + value.slice(4, 10); // Insert dash after year
        }
        input.value = value;
    }
    const addBtn = document.getElementById('add-student-btn');
    const modalOverlay = document.getElementById('modal-overlay');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');

    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modalOverlay.style.display = 'flex';
    });

    cancelBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
    });

    confirmBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
        alert("Student successfully added!");
        // Here, you can submit the form or process the data.
    });
    </script>
</body>

</html>