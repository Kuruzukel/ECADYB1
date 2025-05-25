<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
    }

    body {
        background-color: #000042;
        display: flex;
        flex-direction: column;
        max-height: 100vh;
    }

    header {
        margin-top: 8px;
        background: #1c1c84;
        height: 20rem;
        width: calc(100% - 1rem);
        align-self: center;
        border-radius: 12px;
        display: flex;
        align-items: center;
        padding-inline-start: 1.5rem;
        overflow: hidden;

    }

    .menu-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2rem;
        width: 3rem;
        padding-inline: 12px;
        background-color: #000042;
        border-radius: 8px;
        fill: rgb(209, 209, 209);
        cursor: pointer;
    }

    .menu-btn div {
        display: inherit;
        justify-content: inherit;
        align-items: inherit;
        height: 100%;
        width: 100%;
    }

    .menu-container {
        display: flex;
        align-items: center;
        color: rgb(255, 255, 255);
        font-size: 35px;
    }

    .hidden {
        display: none !important;
    }

    main {
        align-self: center;
        width: calc(100% - 1rem);
        min-height: calc(100vh - 5.5rem);
        margin-top: 0.5rem;
        border-radius: 12px;
        display: flex;
    }

    .sidebar {
        min-height: 100%;
        height: 2000px;
        min-width: 15rem;
        width: 15rem;
        background: #1c1c84;
        border-radius: 12px;
        transition: 300ms;
        margin-right: 10px;
        display: flex;
        flex-direction: column;
        align-items: right;
        overflow: hidden;
        position: relative;

    }

    .sidebar.closed {
        min-width: 0;
        width: 0;
        margin-right: 0;
    }

    .sidebar.closed .logoadmin {
        left: -200px;
        opacity: 0;

    }

    .menu-items {
        margin-top: 1rem;
        transition: margin-top 0.3s ease;
        min-height: 100%;
        height: 2000px;
        min-width: 15rem;
        width: 15rem;
        background: #1c1c84;
        border-radius: 12px;
        transition: 300ms;
        margin-right: 10px;
        display: flex;
        flex-direction: column;
        align-items: right;
        overflow: hidden;
        position: relative;
    }

    .logoadmin {
        width: 200px;
        height: 200px;
        display: block;
        margin: 5 auto;
        padding: 3px 3px;
    }

    .sidebar .logoadmin {
        padding: 1rem;
        align-self: center;
        transition: 300ms;
        margin-left: -6px;
    }

    .line {
        position: relative;
        ;
    }

    .line::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #fff;
        margin-top: 0.1rem;

    }

    .tab {
        position: relative;
        display: block;
        padding: 12px 20px;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .tab.active {
        background-color: #000042;
        border-left: 3px solid rgb(246, 255, 70);
        z-index: 10;
    }

    .tab.active::before {
        content: "";
        position: absolute;
        right: 0;
        bottom: 100%;
        width: 40px;
        height: 0;
        border-radius: 40px;
        box-shadow: 4px 4px 0 -2px #585e69;
    }

    .tab.active::after {
        content: "";
        position: absolute;
        right: 0;
        top: 100%;
        width: 40px;
        height: 0;
        border-radius: 40px;
        box-shadow: 4px -4px 0 -2px #585e69;
    }

    .submenu {
        display: none;
        padding-left: 20px;
        background-color: #3a3f48;
    }

    .submenu.show {
        display: block;
    }

    .sub-tab {
        padding: 10px 20px 10px 30px;
        font-size: 0.9em;
    }

    .sub-tab.active {
        background-color: #4a5059;
        border-left: 3px solid #4CAF50;
    }

    .tab i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    #logout-tab {
        background-color: rgb(208, 1, 1);
        bottom: 76.5rem;
        align-self: flex-end;
        position: absolute;
        border-radius: 1rem;
        width: 90%;
        margin-right: 5%;
        color: #fff;
    }

    #logout-tab:hover {
        background-color: darkred;
    }

    .contents {
        min-height: 100%;
        width: 100%;
        background-color: #fff;
        border-radius: 12px;
        padding-inline: 2rem;
        padding-block-start: 1rem;
        overflow: scroll;
        overflow-y: auto;
    }

    h2 {
        width: 20rem;
    }

    .scroll-container {
        width: 100%;
        height: 2000px;
        overflow: scroll;
        box-sizing: border-box;
    }

    .scroll-container::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    }


    header h3 {
        font-size: 2rem;
    }


    @media screen and (max-width: 500px) {
        header h3 {
            font-size: 1.4rem;
            background: #1c1c84;

        }

        .sidebar {
            min-width: min(100rem, 90vw);
            width: 100rem;
            height: 688px;
            background: #1c1c84;
        }

        .sidebar.closed {
            min-width: 0;
            width: 0;
            background: #1c1c84;
        }

        .contents {
            min-width: -100px;
            width: 100%;
        }

        .logoadmin {
            top: 90px;
            left: 125px;
            height: 200px;
            width: 200px;
            transition: 300ms;

        }

        a {
            text-decoration: none;
            color: black;

        }

        .menu-container {
            display: flex;
            align-items: center;
            color: rgb(255, 255, 255);
            font-size: 14px;

        }

        .menu-btn {
            width: 2rem;
            height: 2rem;
        }

        #logout-tab {
            background-color: rgb(208, 1, 1);
            bottom: 79rem;
            align-self: flex-end;
            position: absolute;
            border-radius: 1rem;
            width: 90%;
            margin-right: 5%;
            color: #fff;
        }

        .scroll-container {
            height: 688px;
        }

        header {
            margin-top: 8px;
            background: #1c1c84;
            width: calc(100% - 1rem);
            align-self: center;
            border-radius: 12px;
            display: flex;
            align-items: center;
            padding-inline-start: 1.5rem;

        }

    }

    @media screen and (max-width: 1120px) and (orientation: portrait) {
        body {
            background-color: #000042;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #logout-tab {
            background-color: rgb(205, 60, 60);
            bottom: 22rem;
            align-self: flex-start;
            position: absolute;
            border-radius: 1rem;
            width: 90%;
            margin-left: 18px;
            color: #fff;
        }
    }

    @media screen and (orientation: landscape) and (max-width: 1023px) {
        #logout-tab {
            background-color: rgb(205, 60, 60);
            bottom: 30rem;
            align-self: flex-start;
            position: absolute;
            border-radius: 1rem;
            width: 90%;
            margin-right: 5%;
            color: #fff;
        }
    }
    </style>
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
            <h3 style="margin-left: 1rem; text-wrap: nowrap; transition: 300ms,;">DIGITAL YEAR BOOK</h3>
        </div>
    </header>
    <main>
        <div class="sidebar closed">
            <img src="../P1.png" alt="Logo" class="logoadmin">
            <div class="line"></div>
            <div class="menu-items">
                <a class="tab" id="addash-tab" onclick="toggleSubmenu('dashboard-submenu')">
                    <i class="fas fa-graduation-cap"></i> Dashboard
                </a>

                <a href="Studdash.php?page=student-list" class="tab sub-tab">Student List</a>
                <a href="Studdash.php?page=add-new-student" class="tab sub-tab">Add New Student</a>
                <a href="Studdash.php?page=edit-student" class="tab sub-tab">Edit Student Info</a>


                <a class="tab" id="announcement-tab" onclick="toggleSubmenu('announcement-submenu')">
                    <i class="fas fa-bullhorn"></i> Announcement
                </a>
                <a href="Studdash.php?page=eventschedule" class="tab sub-tab">Event Schedules</a>

                <a class="tab" id="yearbook-tab" onclick="toggleSubmenu('yearbook-submenu')">
                    <i class="fas fa-book"></i> Digital Year Book
                </a>

                <a href="Studdash.php?page=Maritime" class="tab sub-tab">BS Maritime Education</a>
                <a href="Studdash.php?page=Criminology" class="tab sub-tab">BS Criminology</a>
                <a href="Studdash.php?page=Tourism" class="tab sub-tab">BS Tourism Management</a>
                <a href="Studdash.php?page=Technical" class="tab sub-tab">BS Tech-Voc Teacher Education</a>
                <a href="Studdash.php?page=Nursing" class="tab sub-tab">BS Nursing</a>
                <a href="Studdash.php?page=Information System" class="tab sub-tab">BS Information System</a>
                <a href="Studdash.php?page=Entrepreneurship" class="tab sub-tab">BS Entrepreneurship</a>
                <a href="Studdash.php?page=IManagement Accounting" class="tab sub-tab">BS Management Accounting</a>
                <a class="tab" id="facultyandstaff-tab" onclick="toggleSubmenu('faculty&staff-submenu')">
                    <i class="fas fa-users"></i> Faculty & Staff
                </a>

                <a href="Studdash.php?page=teachermessages" class="tab sub-tab">Teacher Messages</a>
                <a href="Studdash.php?page=staffdirectory" class="tab sub-tab">Staff Directory</a>


                <a href="Studdash.php?page=password" class="tab" id="password-tab"><i class="fas fa-key"></i> Change my
                    password</a>
                <a href="student_logout.php" class="tab" id="logout-tab">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>

        </div>

        </div>

        <div class="scroll-container" id="scrollContainer">
            <div class="contents" id="content">
                <div class="search-container">
                    <form class="search-bar">
                        <i class="fas fa-search"></i> <!-- Classic search icon -->
                        <input type="text" class="search-input" placeholder="Search...">
                        <button type="submit" class="search-button">Search</button>
                    </form>

                    <div id="announcementList" class="mt-6"></div>

                </div>
            </div>

        </div>
        </div>
    </main>
    <script>
    const menuBtn = document.querySelector('.menu-btn')
    const hamburgerIcon = document.querySelector('.hamburger-menu-ico')
    const closeIcon = document.querySelector('.close-ico')
    const sidebar = document.querySelector('.sidebar')

    menuBtn.addEventListener('click', () => {
        if (hamburgerIcon.classList.contains('hidden')) {
            hamburgerIcon.classList.remove('hidden')
            closeIcon.classList.add('hidden')
            sidebar.classList.add('closed')
        } else {
            hamburgerIcon.classList.add('hidden')
            closeIcon.classList.remove('hidden')
            sidebar.classList.remove('closed')
        }
    });


    function toggleSubmenu(id) {
        const submenu = document.getElementById(id);
        if (submenu) {
            submenu.classList.toggle('hidden');
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page') || window.location.pathname.split('/').pop();

        setActiveTab(currentPage);

        expandParentMenuIfActive();
    });



    function setActiveTab(currentPage) {
        document.querySelectorAll('.tab, .sub-tab').forEach(tab => {
            tab.classList.remove('active');

            if (tab.getAttribute('href') && tab.getAttribute('href').includes(currentPage)) {
                tab.classList.add('active');
            }

            if (tab.getAttribute('href') && tab.getAttribute('href').includes(`page=${currentPage}`)) {
                tab.classList.add('active');
            }
        });
    }

    function toggleSubmenu(menuId) {
        const menu = document.getElementById(menuId);
        menu.classList.toggle('show');

        document.querySelectorAll('.submenu').forEach(submenu => {
            if (submenu.id !== menuId && submenu.classList.contains('show')) {
                submenu.classList.remove('show');
            }
        });
    }

    function expandParentMenuIfActive() {
        document.querySelectorAll('.sub-tab.active').forEach(activeSubTab => {
            const submenu = activeSubTab.closest('.submenu');
            if (submenu) {
                submenu.classList.add('show');
            }
        });
    }

    document.querySelectorAll('.tab[onclick]').forEach(tab => {
        tab.addEventListener('click', function(e) {
            if (this.getAttribute('href')) {
                return;
            }
            e.preventDefault();
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    document.querySelectorAll('.sub-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.tab, .sub-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'dashboard';
    document.querySelector(`#${page}-tab`).classList.add('active');

    function scrollToBottom() {
        var container = document.getElementById('scrollContainer');
        container.scrollTop = container.scrollHeight;
    }
    </script>
</body>

</html>