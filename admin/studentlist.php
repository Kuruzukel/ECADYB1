<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        margin-bottom: 3px;
        margin-top: 1px;
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

    .card-header {
        border-bottom: 2px solid #34495e;
        font-size: 1.1em;
        color: #fff;
    }

    .card {}

    .card-datatable {
        padding: 20px;
        min-height: 200px;
        color: #fff;
    }

    .student-header-label {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .student-header-checkbox {
        margin-left: 12px;
        margin-right: 12px;
        height: 20px;
        width: 20px;
    }

    .student-header-text {
        margin-left: 25px;
    }

    .card-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        margin-top: 10px;
        column-gap: 10px;
    }

    .datatable-header-student,
    .datatable-header-id,
    .datatable-header-year,
    .datatable-header-status,
    .datatable-header-actions {
        flex: 1;
    }

    .datatable-header-id {
        flex: 1;
        margin-left: 65px;
    }

    .datatable-header-dept {
        flex: 2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .datatable-header-year {
        flex: 1;
        ;
        margin-right: 65px;
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
                <div class="card-header">
                    <div class="card-header-row">
                        <span class="student-header-label datatable-header-student">
                            <input type="checkbox" id="select-all-header"
                                class="select-all-checkbox student-header-checkbox">
                            <span class="student-header-text">STUDENT</span>
                        </span>
                        <span class="datatable-header-id">ID NUMBER</span>
                        <span class="datatable-header-dept">DEPARTMENT & SECTION</span>
                        <span class="datatable-header-year">ACADEMIC YEAR</span>
                        <span class="datatable-header-status">STATUS</span>
                        <span class="datatable-header-actions">ACTIONS</span>
                    </div>
                </div>

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
});
</script>

</html>