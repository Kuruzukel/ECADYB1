<?php
require __DIR__ . '/../vendor/autoload.php'; 

use MongoDB\Client;

$student = null;
$collection = null;

if (isset($_GET['student_id']) && isset($_GET['collection'])) {
    $studentId = $_GET['student_id'];
    $collectionName = $_GET['collection'];
    
    try {
        $client = new Client("mongodb://localhost:27017");
        $db = $client->Departments;
        $collection = $db->$collectionName;
        
        $student = $collection->findOne(['student id' => $studentId]);
    } catch (Exception $e) {
        $error = "Error fetching student: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Information</title>
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

    .content {
        padding: 20px;
        color: #e0e0e0;
    }

    .back-btn {
        background-color: #217ff7;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
    }

    .back-btn:hover {
        background-color: #1a6fd8;
    }

    .error {
        color: #e74c3c;
        background-color: rgba(231, 76, 60, 0.1);
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .student-info {
        background-color: var(--section-bg);
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .info-row {
        display: flex;
        margin-bottom: 15px;
    }

    .info-label {
        font-weight: bold;
        width: 150px;
        color: #b0b0b0;
    }

    .info-value {
        color: #e0e0e0;
        flex: 1;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <h1>Edit Student Information</h1>
        </div>
        
        <div class="content">
            <a href="studentlist.php" class="back-btn">← Back to Student List</a>
            
            <?php if (isset($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php elseif ($student): ?>
                <div class="student-info">
                    <h2>Student Information</h2>
                    <div class="info-row">
                        <span class="info-label">Student ID:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['student id'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">
                            <?php echo htmlspecialchars(($student['first name'] ?? '') . ' ' . ($student['middle name'] ?? '') . ' ' . ($student['last name'] ?? '')); ?>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Department:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['program'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Section:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['section'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Academic Year:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['academic year'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['email'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Motto:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['motto'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Honors:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['honors'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Milestone:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['milestone'] ?? ''); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Batch Name:</span>
                        <span class="info-value"><?php echo htmlspecialchars($student['batch name'] ?? ''); ?></span>
                    </div>
                </div>
                
                <p style="margin-top: 20px; color: #b0b0b0;">
                    <em>Edit functionality will be implemented here. For now, you can view the student information.</em>
                </p>
            <?php else: ?>
                <div class="error">Student not found.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 