<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="../Assets/css/AdminDashboard.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="sidebar">
            <img src="../../img/ADMINGRALLERYLOGO.png" alt="Logo" class="logoadmin">
            <div class="line"></div>

            <div class="menu-items" style="font-family: 'Oxygen', sans-serif;">
                <a class="tab" id="addash-tab" onclick="toggleSubmenu('dashboard-submenu')">
                    <i class="fas fa-home"></i> Dashboard
                    <span class="chevron"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div id="dashboard-submenu" class="submenu">

                    <a href="AdminDashboard.php?page=student-list" class="tab sub-tab">
                        </i> Student List
                    </a>

                    <a href="AdminDashboard.php?page=add-new-student" class="tab sub-tab">
                        </i> Add New Student
                    </a>

                </div>

                <a class="tab" id="announcement-tab" onclick="toggleSubmenu('announcement-submenu')">
                    <i class="fas fa-bullhorn"></i> Announcement
                    <span class="chevron"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div id="announcement-submenu" class="submenu">

                    <a href="AdminDashboard.php?page=create-announcement" class="tab sub-tab">
                        </i> Create Announcement
                    </a>

                    <a href="AdminDashboard.php?page=event-schedule" class="tab sub-tab">
                        </i> Event Schedules
                    </a>

                </div>

                <a class="tab" id="yearbook-tab" onclick="toggleSubmenu('yearbook-submenu')">
                    <i class="fas fa-book"></i> Digital Year Book
                    <span class="chevron"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div id="yearbook-submenu" class="submenu">
                    <a href="AdminDashboard.php?page=maritime" class="tab sub-tab">
                        </i>Maritime Education
                    </a>

                    <a href="AdminDashboard.php?page=criminology" class="tab sub-tab">
                        </i>College of Criminology
                    </a>

                    <a href="AdminDashboard.php?page=tourism" class="tab sub-tab">
                        </i>Tourism Management
                    </a>

                    <a href="AdminDashboard.php?page=education" class="tab sub-tab">
                        </i>College of Education
                    </a>

                    <a href="AdminDashboard.php?page=nursing" class="tab sub-tab">
                        </i>College of Nursing
                    </a>

                    <a href="AdminDashboard.php?page=informationsys" class="tab sub-tab">
                        </i>Information System
                    </a>

                    <a href="AdminDashboard.php?page=businessad" class="tab sub-tab">
                        </i>Business Administration
                    </a>
                </div>

                <a href="AdminDashboard.php?page=batchupload" class="tab" id="batchupload-tab"
                    onclick="setTabActive('batchupload-tab');">
                    <i class="fas fa-cloud-upload-alt"></i> Batch Upload
                </a>

                <a class="tab" id="customize-tab" onclick="toggleSubmenu('customize-submenu')">
                    <i class="fas fa-sliders-h"></i> Customize
                    <span class="chevron"><i class="fas fa-chevron-down"></i></span>

                </a>

                <div id="customize-submenu" class="submenu">
                    <a href="AdminDashboard.php?page=themes" class="tab sub-tab">
                        </i>Themes
                    </a>

                    <a href="AdminDashboard.php?page=template" class="tab sub-tab">
                        </i>Templates
                    </a>

                </div>

                <a href="AdminDashboard.php?page=changepassword" class="tab" id="changepassword-tab"
                    onclick="setTabActive('changepassword-tab');">
                    <i class="fas fa-key"></i> Change my password
                </a>

                <a href="student_logout.php" class="tab" id="logout-tab">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

            </div>

        </div>

        <div class="scroll-container" id="scrollContainer">
            <div class="contents" id="content">
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
                        <div class="search-container">
                            <input type="text" class="search-input" placeholder="Search..." />
                            <button class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                    </div>
                </header>

                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'studentlist';
                switch ($page) {

                    case 'student-list':
                        include('StudentList.php');
                        break;
                    case 'add-new-student':
                        include('AddNewStudent.php');
                        break;
                    case 'edit-student':
                        include('EditStudentInformation.php');
                        break;
                    case 'create-announcement':
                        include('CreateAnnouncement.php');
                        break;
                    case 'event-schedule':
                        include('EventSchedules.php');
                        break;    
                    case 'batchupload': 
                        include('BatchUpload.php');
                        break;
                    case 'themes':
                        include('Themes.php');
                        break;    
                    case 'template':
                        include('BatchTemplates.php');
                        break;        
                    case 'changepassword':
                        include('ChangePassword.php');
                        break;
                    case 'maritime':
                        include('./Departments/Maritime.php');
                        break;
                    case 'criminology':
                        include('./Departments/Criminology.php');
                        break;
                    case 'tourism':
                        include('./Departments/Tourism.php');
                        break;  
                   case 'education':
                        include('./Departments/Education.php');
                        break; 
                    case 'nursing':
                        include('./Departments/Nursing.php');
                        break;   
                    case 'informationsys':
                        include('./Departments/InformationSystem.php');
                        break;  
                    case 'businessad':
                        include('./Departments/BusinessAdministration.php');
                        break;                    
                    default:
                        include('StudentList.php');
                        break;
                }
                ?>

            </div>

    </main>
    <script src="../Assets/js/AdminDashboard.js">

    </script>
</body>

</html>