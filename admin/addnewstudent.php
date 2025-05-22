<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Details</title>
    <style>
    :root {
        --primary-bg: #000042;
        --header-bg: #0c27be;
        --accent: #0c27be;
        --section-bg: #34495e;
        --section-header: #217ff7;

        --body-bg: #000042;
        --sidebar-bg: #0c27be;
        --content-bg: #112d4e;
        --menu-bg-active: #000042;
        --menu-border-active: #fcda15;
        --menu-hover-bg: #1c1c84;
    }

    .container {
        height: 100%;
        background-color: var(--content-bg);
        border-radius: 10px 10px 0 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .header-container {
        width: 100%;
        height: 50px;
        background-color: var(--header-bg);
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
        background-color: var(--section-bg);
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
        background-color: var(--section-header);
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
    const themes = {
        "Theme 1": {
            "--primary-bg": "#470a0a",
            "--header-bg": "#b21c0e",
            "--accent": "#fcda15",
            "--section-bg": "#bc4f5e",
            "--section-header": "#cb5382",
            "--body-bg": "#470a0a",
            "--sidebar-bg": "#cb0e40",
            "--content-bg": "#bc4f5e",
            "--menu-bg-active": "#cb5382",
            "--menu-border-active": "#fff176",
            "--menu-hover-bg": "#cb5382"
        },
        "Theme 2": {
            "--primary-bg": "#12086F",
            "--header-bg": "#2B35AF",
            "--accent": "#fcda15",
            "--section-bg": "#4895EF",
            "--section-header": "#4CC9F0",
            "--body-bg": "#12086F",
            "--sidebar-bg": "#2B35AF",
            "--content-bg": "#4895EF",
            "--menu-bg-active": "#4CC9F0",
            "--menu-border-active": "#ffffff",
            "--menu-hover-bg": "#4361EE"
        },
        "Theme 3": {
            "--primary-bg": "#0d381e",
            "--header-bg": "#164f2c",
            "--accent": "#fcda15",
            "--section-bg": "#2a834d",
            "--section-header": "#349e5e",
            "--body-bg": "#0d381e",
            "--sidebar-bg": "#1f693c",
            "--content-bg": "#2a834d",
            "--menu-bg-active": "#349e5e",
            "--menu-border-active": "#ffffff",
            "--menu-hover-bg": "#1f693c"
        },
        "Theme 4": {
            "--primary-bg": "#281E18",
            "--header-bg": "#572D0C",
            "--accent": "#fcda15",
            "--section-bg": "#E3B76A",
            "--section-header": "#9D9C75",
            "--body-bg": "#281E18",
            "--sidebar-bg": "#572D0C",
            "--content-bg": "#E3B76A",
            "--menu-bg-active": "#9D9C75",
            "--menu-border-active": "#ffffff",
            "--menu-hover-bg": "#C78E3A"
        },
        "Default": {
            "--primary-bg": "#112d4e",
            "--header-bg": "#0c27be",
            "--accent": "#0c27be",
            "--section-bg": "#34495e",
            "--section-header": "#217ff7",
            "--body-bg": "#000042",
            "--sidebar-bg": "#0c27be",
            "--content-bg": "#112d4e",
            "--menu-bg-active": "#000042",
            "--menu-border-active": "#fcda15",
            "--menu-hover-bg": "#1c1c84"
        }
    };

    function applyTheme(themeName) {
        const theme = themes[themeName] || themes["Default"];
        const root = document.documentElement;
        for (const [key, value] of Object.entries(theme)) {
            root.style.setProperty(key, value);
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('dashboard-theme') || 'Default';
        applyTheme(savedTheme);
    });

    function allowOnlyLetters(input) {
        const sanitized = input.value.replace(/[^a-zA-Z\s]/g, '');
        if (input.value !== sanitized) {
            input.value = sanitized;
        }
    }

    function formatStudentID(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length > 4) {
            value = value.slice(0, 4) + '-' + value.slice(4, 10);
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

    });
    </script>
</body>

</html>