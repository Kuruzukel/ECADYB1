<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="./assets/addash.css" rel="stylesheet">
</head>

<body>
    <header>

        <div class="menu-container">
            <div class="menu-btn">
                <div class="hamburger-menu-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z" />
                    </svg>

                </div>
                <div class="close-ico hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                    </svg>
                </div>
            </div>

            <h3 style="margin-left: 1rem; text-wrap: nowrap; transition: 300ms; font-family: 'Oxygen', sans-serif;">
                Admin Dashboard</h3>
        </div>
    </header>
    <main>
        <div class="sidebar closed">
            <img src="../P1.png" alt="Logo" class="logoadmin">
            <div class="line"></div>

            <div class="menu-items" style="font-family: 'Oxygen', sans-serif;">
                <a class="tab" id="addash-tab" onclick="toggleSubmenu('dashboard-submenu')">
                    <i class="fas fa-home"></i> Dashboard
                    <span class="chevron">
                        <i id="dashboard-chevron" class="fas fa-chevron-down transition-transform duration-300"></i>
                    </span>
                </a>

                <div id="dashboard-submenu" class="submenu">

                    <a href="addash.php?page=student-list" class="tab sub-tab">
                        <i class="fas fa-users"></i> Student List
                    </a>

                    <a href="addash.php?page=add-new-student" class="tab sub-tab">
                        <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Add New Student
                    </a>

                    <a href="addash.php?page=edit-student" class="tab sub-tab">
                        <i class="fas fa-user-edit" style="margin-right: 8px;"></i> Edit Student Info
                    </a>

                </div>

                <a class="tab" id="addash-tab" onclick="toggleSubmenu('announcement-submenu')">
                    <i class="fas fa-bullhorn"></i> Announcement
                    <span class="chevron">
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </span>
                </a>

                <div id="announcement-submenu" class="submenu">

                    <a href="addash.php?page=event-schedule" class="tab sub-tab">
                        <i class="fas fa-calendar-alt" style="margin-right: 8px;"></i> Event Schedules
                    </a>
                </div>

                <a class="tab" id="yearbook-tab" onclick="toggleSubmenu('yearbook-submenu')">
                    <i class="fas fa-book"></i> Digital Year Book
                    <span class="chevron">
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </span>
                </a>

                <div id="yearbook-submenu" class="submenu">
                    <a href="addash.php?page=maritime" class="tab sub-tab">
                        <i class="fas fa-anchor" style="margin-right: 8px;"></i>Maritime Education
                    </a>

                    <a href="Studdash.php?page=Criminology" class="tab sub-tab">
                        <i class="fas fa-user-shield" style="margin-right: 8px;"></i>Criminology
                    </a>

                    <a href="Studdash.php?page=Tourism" class="tab sub-tab">
                        <i class="fas fa-plane-departure" style="margin-right: 8px;"></i>Tourism Management
                    </a>

                    <a href="Studdash.php?page=Education" class="tab sub-tab">
                        <i class="fas fa-book-open" style="margin-right: 8px;"></i>College of Education
                    </a>

                    <a href="Studdash.php?page=Nursing" class="tab sub-tab">
                        <i class="fas fa-first-aid" style="margin-right: 8px;"></i>Nursing
                    </a>

                    <a href="Studdash.php?page=Information System" class="tab sub-tab">
                        <i class="fas fa-laptop-code" style="margin-right: 8px;"></i>Information System
                    </a>

                    <a href="Studdash.php?page=Business" class="tab sub-tab">
                        <i class="fas fa-chart-bar" style="margin-right: 8px;"></i>Business Administration
                    </a>
                </div>

                <a href="addash.php?page=batchupload" class="tab" id="batchupload-tab"
                    onclick="setTabActive('batchupload-tab');">
                    <i class="fas fa-cloud-upload-alt"></i> Batch Upload
                </a>

                <a href="addash.php?page=changepassword" class="tab" id="changepassword-tab"
                    onclick="setTabActive('changepassword-tab');">
                    <i class="fas fa-key"></i> Change my password
                </a>

                <a href="student_logout.php" class="tab" id="logout-tab">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

            </div>

        </div>

        </div>

        <div class="scroll-container" id="scrollContainer">
            <div class="contents" id="content">



                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'studentlist';
                switch ($page) {

                    case 'student-list':
                        include('studentlist.php');
                        break;
                    case 'add-new-student':
                        include('addnewstudent.php');
                        break;
                    case 'edit-student':
                        include('editstudentinfo.php');
                        break;
                    case 'announcement':
                        include('announcement.php');
                        break;
                    case 'event-schedule':
                        include('eventschedules.php');
                        break;
                    case 'batchupload': 
                        include('batchupload.php');
                        break;
                    case 'changepassword':
                        include('changepass.php');
                        break;
                    case 'maritime':
                        include('maritime.php');
                        break;
                    default:
                        include('studentlist.php');
                        break;
                }
                ?>

            </div>

        </div>

    </main>
    <script src="./assets/addash.js">

    </script>
</body>

</html>