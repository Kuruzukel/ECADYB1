<?php
require '../vendor/autoload.php';
use MongoDB\Client;

$uploadStatus = [
    'top_management_message' => null,
    'student_info' => null
];

function isValidCSV($fileTmpName) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $fileTmpName);
    finfo_close($finfo);
    return in_array($mimeType, [
        'text/plain',
        'text/csv',
        'application/csv',
        'application/vnd.ms-excel',
        'application/octet-stream'
    ]);
}

function cleanHeader($col) {
    $col = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $col); 
    $col = str_replace(["\xEF\xBB\xBF"], '', $col); 
    return strtolower(preg_replace('/[\s_]+/', '', trim($col))); 
}

function importCSVToMongoByDepartment($tmpName, $departmentsDB) {
    if (!isValidCSV($tmpName)) return false;

    $header = null;
    $dataByDepartment = [];

    if (($handle = fopen($tmpName, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $row = array_map('trim', $row);
            if (!$header) {
                $header = array_map(function($col) {
                    return match(cleanHeader($col)) {
                        'id' => 'id',
                        'academicyear' => 'academic year',
                        'departmentsection', 'departamentsection' => 'department section',
                        'studentid' => 'student id',
                        'lastname' => 'last name',
                        'firstname' => 'first name',
                        'middlename' => 'middle name',
                        'motto' => 'motto',
                        'honors' => 'honors',
                        'milestone' => 'milestone',
                        'email' => 'email',
                        'batchname' => 'batch name',
                        default => cleanHeader($col)
                    };
                }, $row);
            } elseif (count($row) === count($header)) {
                $record = array_combine($header, $row);
                if (!isset($record['department section'])) continue;

                preg_match('/^[^\s-]+/', $record['department section'], $matches);
                if (empty($matches)) continue;
                $dept = strtolower($matches[0]);

                $dataByDepartment[$dept][] = $record;
            }
        }
        fclose($handle);
    }

    if (!empty($dataByDepartment)) {
        foreach ($dataByDepartment as $dept => $records) {
            $collection = $departmentsDB->$dept;
            $collection->drop();
            $collection->insertMany($records);
        }
        return true;
    }
    return false;
}

function importCSVByMessage($tmpName, $collection) {
    if (!isValidCSV($tmpName)) return false;

    $header = null;
    $dataByMessage = [];

    if (($handle = fopen($tmpName, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $row = array_map('trim', $row);
            if (!$header) {
                $header = array_map('cleanHeader', $row);
            } elseif (count($row) === count($header)) {
                $dataByMessage[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }

    if (!empty($dataByMessage)) {
        $collection->drop();
        $collection->insertMany($dataByMessage);
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client = new Client("mongodb://localhost:27017");


    if (!empty($_FILES['top_management_message']['tmp_name'])) {
        $tmpName = $_FILES['top_management_message']['tmp_name'];

        $validTopManagementHeaders = ['name', 'message','batch_name', 'academic_year'];
        $validTopManagementHeaders = array_map('cleanHeader', $validTopManagementHeaders);
        $actualHeaders = [];

        if (($handle = fopen($tmpName, 'r')) !== false) {
            if (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $actualHeaders = array_map('cleanHeader', $row);
            }
            fclose($handle);
        }

        sort($validTopManagementHeaders);
        sort($actualHeaders);

        if ($actualHeaders === $validTopManagementHeaders) {
            $topManagementDB = $client->Top_Management;
            $uploadStatus['top_management_message'] = importCSVByMessage($tmpName, $topManagementDB->message);
        } else {
            $uploadStatus['top_management_message'] = false;
        }
    }


    if (!empty($_FILES['student_info']['tmp_name'])) {
        $departmentsDB = $client->Departments;
        $uploadStatus['student_info'] = importCSVToMongoByDepartment($_FILES['student_info']['tmp_name'], $departmentsDB);
    }

    $resultMsg = null;
    if ($uploadStatus['top_management_message'] || $uploadStatus['student_info']) {
        $resultMsg = "Upload successful!";
    } elseif ($uploadStatus['top_management_message'] === false || $uploadStatus['student_info'] === false) {
        $resultMsg = "One or more uploads failed. Please ensure you're using valid CSV files.";
    }
}
?>

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

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
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
        font-family: "SF Pro", "SF Pro Display", "SF Pro Text", -apple-system,
            BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    h1 {
        margin: 0;
        color: #ffffff;
        font-size: 24px;
    }

    .form-content {
        padding: 25px;
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
        min-height: 555px;
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

    .file-card {
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #34495e;
        border: 2px dashed #cbd5e0;
        min-height: 200px;
        transition: border-color 0.3s ease, background-color 0.3s ease;
        text-align: center;
    }

    .file-card:hover {
        border-color: #2196f3;
    }

    .custom-upload {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        color: #fff;
        border: none;
        padding: 15px 35px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        font-weight: 500;
    }

    .custom-upload:hover {
        transform: translateY(-2px);
    }

    .upload-input {
        display: none;
    }

    .upload-success {
        border-color: #2ecc71;
        background-color: #14532d;
        color: white;
    }

    .upload-failed {
        border-color: #e74c3c;
        background-color: #7f1d1d;
        color: white;
    }

    .popup-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 25px 40px;
        border-radius: 10px;
        font-size: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        animation: fadeOut 3s forwards;
    }

    .popup-success {
        background-color: #2ecc71;
        color: white;
    }

    .popup-failure {
        background-color: #e74c3c;
        color: white;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        80% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-container">
            <h1>Upload Section</h1>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-content">
                <div class="form-group">
                    <!-- Top Message Upload -->
                    <div class="section">
                        <div class="section-header">Top Management Message</div>
                        <div
                            class="file-card <?= $uploadStatus['top_management_message'] === false ? 'upload-failed' : ($uploadStatus['top_management_message'] === true ? 'upload-success' : '') ?>">
                            <label class="custom-upload" for="top_management_message">Upload CSV File</label>
                            <input type="file" name="top_management_message" id="top_management_message"
                                class="upload-input" accept=".csv">
                        </div>
                    </div>

                    <!-- Student Info Upload -->
                    <div class="section">
                        <div class="section-header">Student Information</div>
                        <div
                            class="file-card <?= $uploadStatus['student_info'] === false ? 'upload-failed' : ($uploadStatus['student_info'] === true ? 'upload-success' : '') ?>">
                            <label class="custom-upload" for="student-info">Upload CSV File</label>
                            <input type="file" name="student_info" id="student-info" class="upload-input" accept=".csv">
                        </div>
                    </div>

                    <!-- Image Upload (future use) -->
                    <div class="section">
                        <div class="section-header">Student Photo, Template, and Logos</div>
                        <div class="file-card">
                            <label class="custom-upload" for="image-upload">Upload Image Folder</label>
                            <input type="file" id="image-upload" class="upload-input" accept="image/*" multiple>
                        </div>
                    </div>
                </div>

                <?php if (!empty($resultMsg)): ?>
                <?php
                    $popupClass = in_array(true, $uploadStatus, true) ? 'popup-success' : 'popup-failure';
                ?>
                <div class="popup-message <?= $popupClass ?>"><?= $resultMsg ?></div>
                <?php endif; ?>
            </div>
        </form>
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
            "--accent": "#fcda15",
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

        document.querySelectorAll('.upload-input').forEach(input => {
            input.addEventListener('change', () => {
                if (input.files.length > 0) {
                    input.form.submit();
                }
            });
        });
    });
    </script>
</body>

</html>