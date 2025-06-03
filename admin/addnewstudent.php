<?php
require __DIR__ . '/../vendor/autoload.php'; // MongoDB library

use MongoDB\Client;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');

    // Connect to MongoDB
    $client = new Client("mongodb://localhost:27017");
    $db = $client->Departments;

    // Map program short codes to full names
    $programMap = [
        "bsme" => "BS Marine Engineering",
        "bsmt" => "BS Marine Transportation",
        "bscje" => "BS Criminal Justice Education",
        "bstm" => "BS Tourism Management",
        "btvted" => "BS Technical-Vocational Teacher Education",
        "beced" => "BS Early Childhood Education",
        "bsn" => "BS Nursing",
        "bsis" => "BS Information System",
        "bsma" => "BS Management Accounting",
        "bse" => "BS Entrepreneurship"
    ];

    $programKey = $_POST["program"] ?? '';
    $programName = $programMap[$programKey] ?? 'Unknown';

    $section = trim($_POST["section"] ?? '');

    // Prepare student document
    $student = [
        "first name" => trim($_POST["first_name"] ?? ''),
        "middle name" => trim($_POST["middle_name"] ?? ''),
        "last name" => trim($_POST["last_name"] ?? ''),
        "email" => trim($_POST["email"] ?? ''),
        "academic year" => trim($_POST["academic_year"] ?? ''),
        "student id" => trim($_POST["student_id"] ?? ''),
        "program" => $programName,
        "section" => $section,
        "department section" => $programName . ' - ' . $section,
        "motto" => trim($_POST["motto"] ?? ''),
        "honors" => trim($_POST["honors"] ?? ''),
        "milestone" => trim($_POST["milestone"] ?? '')
    ];

    // Select the appropriate collection
    $collection = $db->$programKey;

    // Count existing documents and set custom auto-incremented ID
    $studentCount = $collection->countDocuments();
    $student["id"] = $studentCount + 1;

    // Insert student into the collection
    $collection->insertOne($student);

    echo json_encode([
        "success" => true,
        "message" => "Student added successfully to '$programKey' collection with ID {$student['id']}."
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Student</title>
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

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        width: 100%;
        background-color: var(--body-bg);
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

    .section input,
    .section select,
    .section textarea {
        margin-bottom: 16px;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #f0f0f0;
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

                    <label for="email">Email:</label>
                    <input type="text" id="email" placeholder="Email">

                </div>

                <div class="section">
                    <div class="section-header">Academic Information</div>

                    <label for="academic-year">Academic Year:</label>
                    <input type="text" id="academic-year" placeholder="0000-0000" maxlength="9"
                        oninput="formatStudentID(this)">

                    <label for="department">Program:</label>
                    <select id="program">
                        <option value="" disabled selected>Select a program</option>
                        <option value="bsme">BS Marine Engineering</option>
                        <option value="bsmt">BS Marine Transportation</option>
                        <option value="bscje">BS Criminal Justice Education</option>
                        <option value="bstm">BS Tourism Management</option>
                        <option value="btvted">BS Technical-Vocational Teacher Education</option>
                        <option value="beced">BS Early Childhood Education</option>
                        <option value="bsn">BS Nursing</option>
                        <option value="bsis">BS Information System</option>
                        <option value="bsma">BS Management Accounting</option>
                        <option value="bse">BS Entrepreneurship</option>
                    </select>


                    <label for="section">Section:</label>
                    <input type="text" id="section" placeholder="Section" oninput="allowOnlyLetters(this)">

                    <label for="student-id">Student ID:</label>
                    <input type="text" id="student-id" placeholder="0000-000000" maxlength="11"
                        oninput="formatStudentID(this)">

                </div>

                <div class="section">
                    <div class="section-header">Additional Information</div>
                    <label for="motto">Personal Philosophy:</label>
                    <input type="text" id="motto" placeholder="Personal Philosophy">

                    <label for="honors">Latin Awards:</label>
                    <input type="text" id="honors" placeholder="Latin Awards" oninput="allowOnlyLetters(this)">

                    <label for="milestone">Career Highlights:</label>
                    <input type="text" id="milestone" placeholder="Career Highlights" oninput="allowOnlyLetters(this)">

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
            "--sidebar-bg": "#b21c0e",
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
            "--sidebar-bg": "#164f2c",
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
        let sanitized = input.value.replace(/[^a-zA-Z\s]/g, '');
        sanitized = sanitized.replace(/\s+/g, ' '); // replace multiple spaces with one
        sanitized = sanitized.replace(/^\s+|\s+$/g, ''); // trim leading/trailing spaces
        input.value = sanitized;
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

                const formData = new FormData();
                formData.append('first name', document.getElementById('first-name').value.trim());
                formData.append('middle name', document.getElementById('middle-name').value.trim());
                formData.append('last name', document.getElementById('last-name').value.trim());
                formData.append('email', document.getElementById('email').value.trim());
                formData.append('academic year', document.getElementById('academic-year').value.trim());
                formData.append('program', document.getElementById('program').value);
                formData.append('section', document.getElementById('section').value.trim());
                formData.append('student id', document.getElementById('student-id').value.trim());
                formData.append('motto', document.getElementById('motto').value.trim());
                formData.append('honors', document.getElementById('honors').value.trim());
                formData.append('milestone', document.getElementById('milestone').value.trim());

                fetch('', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        alert(result.message);
                        if (result.success) {
                            window.location.reload();
                        }
                    })
    </script>
</body>

</html>