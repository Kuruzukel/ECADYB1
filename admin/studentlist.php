<?php
require __DIR__ . '/../vendor/autoload.php'; 

use MongoDB\Client;

// Connect to MongoDB
$client = new Client("mongodb://localhost:27017");
$db = $client->Departments;

// Define all program collections
$collections = [
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

$allStudents = [];

// Password generator function
function generatePassword($length = 8) {
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $digits = '0123456789';
    $special = '!@#$%^&*()_+-={}[]|:;<>,.?';
    
    $password = '';
    // Ensure at least one uppercase and one special character
    $password .= $upper[random_int(0, strlen($upper) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];
    
    $all = $upper . $lower . $digits . $special;
    for ($i = 2; $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }
    // Shuffle to randomize position
    return str_shuffle($password);
}

// Fetch students from all collections
foreach ($collections as $collectionKey => $programName) {
    try {
        $collection = $db->$collectionKey;
        $cursor = $collection->find();
        
        foreach ($cursor as $student) {
            // Check if password exists
            if (empty($student['password'])) {
                $password = generatePassword(8);
                // Update the student document in MongoDB
                $collection->updateOne(
                    ['_id' => $student['_id']],
                    ['$set' => ['password' => $password]]
                );
            } else {
                $password = $student['password'];
            }

            $allStudents[] = [
                'id' => $student['id'] ?? '',
                'student_id' => $student['student id'] ?? '',
                'first_name' => $student['first name'] ?? '',
                'middle_name' => $student['middle name'] ?? '',
                'last_name' => $student['last name'] ?? '',
                'department_section' => $student['department section'] ?? $programName,
                'academic_year' => $student['academic year'] ?? '',
                'status' => 'Active', // Default status
                'collection' => $collectionKey,
                'password' => $password // Use the stored/generated password
            ];
        }
    } catch (Exception $e) {
        // Skip collections that don't exist
        continue;
    }
}

// Sort students by ID
usort($allStudents, function($a, $b) {
    return $a['id'] - $b['id'];
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
        font-family: Arial, sans-serif;
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
        font-family: "SF Pro", "SF Pro Display", "SF Pro Text", -apple-system,
            BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    h1 {
        margin: 0;
        color: #ffffff;
        font-size: 24px;
        width: 100%;
    }

    .form-content,
    .filter-bar {
        font-family: Arial, sans-serif;
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
        min-height: 520px;
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

    .filter-bar {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 3px;
        height: 50px;
        width: 100%;
        border-radius: 8px;
        justify-content: space-between;
        padding: 10px;
    }

    .filter-label {
        flex: 1;
        min-width: 0;
    }

    .filter-select {
        padding: 6px 12px;
        border-radius: 8px;
        border: 2px solid #34495e;
        background: transparent;
        color: #fff;
        height: 35px;
        min-width: 120px;
        max-width: 100%;
        width: 100%;
        font-family: Arial, sans-serif;
        font-size: .9em;
        box-sizing: border-box;
    }

    .filter-select option {
        background: #112d4e;
        color: #fff;
    }

    .select-all-label {
        display: flex;
        align-items: center;
        color: rgb(255, 255, 255);
        margin-left: auto;
        height: 20px;
    }

    .select-all-checkbox {
        margin-right: 8px;
        accent-color: #217ff7;
    }


    .card-datatable {
        padding: 8px;
        min-height: 200px;
        color: #b0b0b0;
        width: 100%;
        box-sizing: border-box;
    }

    /* Student row styles */
    .student-row {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid #34495e;
        background-color: rgba(255, 255, 255, 0.05);
        transition: background-color 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .student-row:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .student-row:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.04);
    }

    .student-row:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.09);
    }

    .student-row:nth-child(odd):hover {
        background-color: rgba(255, 255, 255, 0.04);
    }

    .student-row:nth-child(even):hover {
        background-color: rgba(255, 255, 255, 0.16);
    }

    .student-row.header {
        background-color: rgba(255, 255, 255, 0.16) !important;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .student-checkbox {
        height: 18px;
        width: 18px;
        accent-color: rgb(0, 255, 13);

    }

    .student-name {
        flex: 1;
        font-weight: 500;
        color: #fff;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: center;
        padding-right: 5rem;
    }

    .student-header-text {
        margin-left: 25px;
        text-align: right;
        justify-content: flex-end;
        display: flex;
        align-items: center;
        color: #fff;

    }

    .student-dept {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-left: -2rem;
        display: flex;
        justify-content: center;
        /* center horizontally */
        align-items: center;
        /* center vertically */
        color: #fff;

    }


    .student-year {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        justify-content: center;
        /* center horizontally */
        align-items: center;
        /* center vertically */
        color: #fff;

    }

    .student-status {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        justify-content: center;
        /* center horizontally */
        align-items: center;
        /* center vertically */
        color: #fff;
        padding-right: 3em;
        margin-right: -11rem;
    }

    .student-actions {
        flex: 0 0 120px;
        max-width: 120px;
        min-width: 100px;
        justify-content: left;
        text-align: left;
        gap: 5px;
    }

    .action-btn {
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .edit-btn {
        background: transparent !important;
        color: #217ff7;
        border: none;
        cursor: pointer;
        font-size: 18px;
        transition: color 0.3s ease;
        display: flex;
    }


    .delete-btn {
        background: transparent !important;
        color: #e74c3c;
        border: none;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s ease;
        display: flex;

    }



    .status-active {
        color: rgb(0, 255, 13) !important;
        font-weight: 500;
    }

    .status-pending {
        color: #f39c12;
        font-weight: 500;
    }

    .no-students {
        text-align: center;
        padding: 40px;
        color: #fff;
        font-style: italic;
    }



    /* Alignment for student row and header columns */

    .eyeIcon-list {
        margin-left: 0.5em;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .password-text {
        color: #fff;
        font-size: 14px;
        text-align: left;
    }

    .eyeIcon-list svg path[fill="#000000"] {
        fill: #FFFFFF !important;
    }



    .student-id,
    .student-dept,
    .student-year,
    .student-status,
    .student-password,
    .student-actions {
        flex: 1;
        text-align: left;

        justify-content: flex-start;
        display: flex;
        align-items: center;
        padding: 0;
        color: #fff;
    }



    .student-name-header,
    .student-id-header,
    .student-dept-header,
    .student-year-header,
    .student-status-header,
    .student-password-header,
    .student-actions-header {
        text-align: left !important;
        justify-content: flex-start !important;
    }


    .student-name-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: center;
        justify-content: center;
        display: flex;
        align-items: center;
        padding-right: 4.8rem;
    }

    .student-id-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: center;
        justify-content: center;
        display: flex;
        align-items: center;

    }

    .student-dept-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: center;
    }

    .student-year-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: center;
    }

    .student-status-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: center;
    }

    .student-password-header,
    .student-password {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .student-password-header {
        flex: 1;
        font-weight: bold;
        color: #fff;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: center;
    }

    .student-password-header.student-password {
        margin-left: 0;
        padding-left: 7em;
    }

    .student-password {
        padding-left: 7em;
    }

    .student-actions-header {
        flex: 0 0 120px;
        max-width: 120px;
        min-width: 100px;
        justify-content: left;
        text-align: left;
    }

    .student-actions-header.student-actions {
        padding-left: 0;
    }

    /* Make the first row of tbody have the same color as even rows */


    tr.student-row {
        padding: 12px 16px;
    }

    .student-row.header th {
        font-weight: bold;
        padding-top: 10px;
        padding-bottom: 10px;
        /* Add more styles as needed */
    }

    table {
        table-layout: fixed;
        width: 100%;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="header-container" style="width: 100%;">
            <h1>Student List</h1>
        </div>
        <div class="form-content" style="width: 100%, ">
            <div class="card">
                <div class="card-header">
                    <div class="filter-bar">
                        <label for="entries-count" class="filter-label">
                            <select id="entries-count" class="filter-select">
                                <option value="" disabled selected>Show Users</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </label>
                        <label for="department-filter" class="filter-label">
                            <select id="department-filter" class="filter-select">
                                <option value="" disabled selected>Select Department</option>
                                <option value="maritime">Maritime Education</option>
                                <option value="criminology">Criminology</option>
                                <option value="tourism">Tourism Management</option>
                                <option value="education">College of Education</option>
                                <option value="nursing">Nursing</option>
                                <option value="information">Information System</option>
                                <option value="business">Business Administration</option>
                                <!-- Add more departments as needed -->
                            </select>
                        </label>
                        <label for="status-filter" class="filter-label">
                            <select id="status-filter" class="filter-select">
                                <option value="" disabled selected>Select Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                            </select>
                        </label>
                    </div>
                </div>

                <!-- Student Data Section -->
                <div class="card-datatable">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr class="student-row header">
                                <th class="student-name-header student-name">STUDENT</th>
                                <th class="student-id-header student-id">ID NUMBER</th>
                                <th class="student-dept-header student-dept">DEPARTMENT</th>
                                <th class="student-year-header student-year">ACADEMIC YEAR</th>
                                <th class="student-status-header student-status">STATUS</th>
                                <th class="student-password-header student-password">PASSWORD</th>
                                <th class="student-actions-header student-actions">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($allStudents)): ?>
                            <tr class="no-students">
                                <td colspan="7" style="text-align:center; padding:40px; color:#fff; font-style:italic;">
                                    No students found in the database.</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($allStudents as $student): ?>
                            <tr class="student-row">
                                <td class="student-name">
                                    <?php echo htmlspecialchars($student['last_name'] . ', ' . $student['first_name'] . ' ' . $student['middle_name']); ?>
                                </td>
                                <td class="student-id"><?php echo htmlspecialchars($student['student_id']); ?></td>
                                <td class="student-dept"><?php echo htmlspecialchars($student['department_section']); ?>
                                </td>
                                <td class="student-year"><?php echo htmlspecialchars($student['academic_year']); ?></td>
                                <td class="student-status status-active">
                                    <?php echo htmlspecialchars($student['status']); ?></td>
                                <td class="student-password">
                                    <span class="password-text"
                                        data-password="<?php echo htmlspecialchars($student['password']); ?>">********</span>
                                </td>
                                <td class="student-actions">
                                    <div class="eyeIcon close eyeIcon-list"
                                        style="margin-right:0.5em;display:flex;align-items:center;cursor:pointer;"
                                        onclick="togglePass(this)">
                                        <!-- SVG for closed eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            style="height: 1.2em; vertical-align: middle;">
                                            <g fill="none" fill-rule="evenodd">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="#000000"
                                                    d="M2.5 9a1.5 1.5 0 0 1 2.945-.404c1.947 6.502 11.158 6.503 13.109.005a1.5 1.5 0 1 1 2.877.85a10.1 10.1 0 0 1-1.623 3.236l.96.96a1.5 1.5 0 1 1-2.122 2.12l-1.01-1.01a9.6 9.6 0 0 1-1.67.915l.243.906a1.5 1.5 0 0 1-2.897.776l-.251-.935c-.705.073-1.417.073-2.122 0l-.25.935a1.5 1.5 0 0 1-2.898-.776l.242-.907a9.6 9.6 0 0 1-1.669-.914l-1.01 1.01a1.5 1.5 0 1 1-2.122-2.12l.96-.96a10.1 10.1 0 0 1-1.62-3.23A1.5 1.5 0 0 1 2.5 9" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="eyeIcon open eyeIcon-list"
                                        style="margin-right:0.5em;display:none;align-items:center;cursor:pointer;"
                                        onclick="togglePass(this)">
                                        <!-- SVG for open eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            style="height: 1.2em; vertical-align: middle;">
                                            <g fill="none">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="#000000"
                                                    d="M12 5c3.679 0 8.162 2.417 9.73 5.901c.146.328.27.71.27 1.099c0 .388-.123.771-.27 1.099C20.161 16.583 15.678 19 12 19s-8.162-2.417-9.73-5.901C2.124 12.77 2 12.389 2 12c0-.388.123-.771.27-1.099C3.839 7.417 8.322 5 12 5m0 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8m0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4" />
                                            </g>
                                        </svg>
                                    </div>
                                    <input type="checkbox" class="student-checkbox"
                                        data-student-id="<?php echo htmlspecialchars($student['student_id']); ?>">
                                    <button class="action-btn edit-btn"
                                        onclick="editStudent('<?php echo htmlspecialchars($student['student_id']); ?>', '<?php echo htmlspecialchars($student['collection']); ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn"
                                        onclick="deleteStudent('<?php echo htmlspecialchars($student['student_id']); ?>', '<?php echo htmlspecialchars($student['collection']); ?>')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    </div>
</body>
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

    // Initialize select all functionality
    initializeSelectAll();

    // Initialize filters
    initializeFilters();
});

// Select all functionality
function initializeSelectAll() {
    const selectAllCheckbox = document.getElementById('select-all-header');
    const studentCheckboxes = document.querySelectorAll('.student-checkbox');

    selectAllCheckbox.addEventListener('change', function() {
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Update select all when individual checkboxes change
    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(studentCheckboxes).every(cb => cb.checked);
            const anyChecked = Array.from(studentCheckboxes).some(cb => cb.checked);

            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = anyChecked && !allChecked;
        });
    });
}

// Filter functionality
function initializeFilters() {
    const entriesCount = document.getElementById('entries-count');
    const departmentFilter = document.getElementById('department-filter');
    const statusFilter = document.getElementById('status-filter');

    // Add event listeners for filters
    [entriesCount, departmentFilter, statusFilter].forEach(filter => {
        if (filter) {
            filter.addEventListener('change', function() {
                applyFilters();
            });
        }
    });
}

function applyFilters() {
    const departmentFilter = document.getElementById('department-filter').value;
    const statusFilter = document.getElementById('status-filter').value;
    const studentRows = document.querySelectorAll('.student-row');

    studentRows.forEach(row => {
        let showRow = true;

        // Department filter
        if (departmentFilter && departmentFilter !== '') {
            const deptText = row.querySelector('.student-dept').textContent.toLowerCase();
            if (!deptText.includes(departmentFilter.toLowerCase())) {
                showRow = false;
            }
        }

        // Status filter
        if (statusFilter && statusFilter !== '') {
            const statusText = row.querySelector('.student-status').textContent.toLowerCase();
            if (statusText !== statusFilter.toLowerCase()) {
                showRow = false;
            }
        }

        row.style.display = showRow ? 'flex' : 'none';
    });
}

// Edit student function
function editStudent(studentId, collection) {
    // Redirect to edit page with student ID and collection
    window.location.href =
        `editstudentinfo.php?student_id=${encodeURIComponent(studentId)}&collection=${encodeURIComponent(collection)}`;
}

// Delete student function
function deleteStudent(studentId, collection) {
    if (confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
        // Send delete request to server
        fetch('delete_student.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    student_id: studentId,
                    collection: collection
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Student deleted successfully!');
                    location.reload(); // Reload the page to update the list
                } else {
                    alert('Error deleting student: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting student. Please try again.');
            });
    }
}


function togglePass(icon) {

    const studentRow = icon.closest('.student-row');
    if (!studentRow) return;


    const passwordText = studentRow.querySelector('.password-text');
    if (!passwordText) return;


    const eyeOpen = studentRow.querySelector('.eyeIcon.open.eyeIcon-list');
    const eyeClose = studentRow.querySelector('.eyeIcon.close.eyeIcon-list');


    if (eyeClose && eyeClose.style.display !== 'none') {

        passwordText.textContent = passwordText.getAttribute('data-password');
        passwordText.style.color = '#FFFFFF';
        passwordText.style.fontSize = '14px';
        passwordText.style.filter = '';
        eyeClose.style.display = 'none';
        if (eyeOpen) eyeOpen.style.display = 'flex';
    } else {

        passwordText.textContent = '********';
        passwordText.style.color = '#FFFFFF';
        passwordText.style.fontSize = '14px';
        passwordText.style.filter = '';
        if (eyeClose) eyeClose.style.display = 'flex';
        if (eyeOpen) eyeOpen.style.display = 'none';
    }
}
</script>

</html>