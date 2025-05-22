<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Announcement</title>
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

    .announcement-container {
        height: 100%;
        width: 100%;
        background-color: var(--content-bg);
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
        overflow: hidden;
        margin-top: 20px;
    }

    .announcement-header {
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

    .announcement-header h2 {
        margin: 0;
        font-size: 24px;
    }

    .announcement-body {
        height: 100%;
        padding: 30px;
    }

    h2 {
        margin: 0;
        color: #ffffff;
        font-size: 24px;
        width: 100%;
    }

    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: bold;
        color: #e0e0e0;
        font-size: 16px;
        letter-spacing: 0.5px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .submit-btn {
        width: 200px;
        height: 45px;
        display: block;
        margin: 60px auto 0;
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

    .modal h3 {
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

    @media (max-width: 768px) {
        .announcement-container {
            margin: 20px;
        }

        .announcement-body {
            padding: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="announcement-container" style=" margin: 0 auto;">
        <div style="font-family: Arial, sans-serif;">
            <div class="announcement-header">
                <h2>Create Announcement</h2>
            </div>
            <div class="announcement-body" style="min-height: 570px;">
                <form id="announcementForm" action="submit_announcement.php" method="post">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter announcement title" required />
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write your announcement here..."
                        required></textarea>

                    <label for="date">Date (optional)</label>
                    <input type="date" id="date" name="date" />

                    <label for="time">Time (optional)</label>
                    <input type="time" id="time" name="time" />

                    <button class="submit-btn" id="post-announcement-btn">Post Announcement</button>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" id="modal-overlay">
            <div class="modal" style="font-family: Arial, sans-serif;">
                <h3>Are you sure you want to post this announcement?</h3>
                <div class="modal-buttons">
                    <button class="modal-btn confirm" id="confirm-btn">Yes, Post</button>
                    <button class="modal-btn cancel" id="cancel-btn">Cancel</button>
                </div>
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


    const postBtn = document.getElementById('post-announcement-btn');
    const modalOverlay = document.getElementById('modal-overlay');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const form = document.getElementById('announcementForm');


    postBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modalOverlay.style.display = 'flex';
    });


    cancelBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
    });


    confirmBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
        form.submit();
    });
    </script>
</body>

</html>