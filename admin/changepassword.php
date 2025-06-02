<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
    <script src="https://kit.fontawesome.com/a2e0f5f0b2.js" crossorigin="anonymous"></script>
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

    .changepass-container {
        height: 100%;
        background-color: var(--content-bg);
        border-radius: 10px 10px 0 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .changepass-header {
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

    .changepass-header h2 {
        margin: 0;
        font-size: 24px;
    }

    .changepass-body {
        width: 100%;
        padding: 30px;
        position: relative;
    }

    .changepass-body input {
        height: 2.5rem;
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

    .field {
        width: 20rem;
    }

    .pass.field {
        margin-top: 2rem;
        width: 100%;
    }

    .handle {
        color: #FFFFFF;
        display: flex;
        justify-content: left;
        gap: 16px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .passwordField {
        position: relative;
    }

    .eyeIcon {
        height: 1.5rem;
        width: 1.5rem;
        position: absolute;
        top: 0.5rem;
        right: 1rem;
        cursor: pointer;
    }

    .passwordField[data-isVisible="false"] .eyeIcon.open {
        display: none;
    }

    .passwordField[data-isVisible="false"] .eyeIcon.close {
        display: block;
    }

    .passwordField[data-isVisible="true"] .eyeIcon.close {
        display: none;
    }

    .passwordField[data-isVisible="true"] .eyeIcon.open {
        display: block;
    }


    input {
        background-color: rgb(255, 255, 255);
        color: black;
        border: none;
        outline: none;
        width: 100%;
        border-radius: 5px;
        padding-inline: 1rem;
        font-size: 1rem;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        appearance: textfield;
        -moz-appearance: textfield;
    }


    .submit-btn {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        width: 200px;
        height: 45px;
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
        .changepass-container {
            margin: 20px;
        }

        .changepass-body {
            padding: 20px;
        }
    }
    </style>
</head>

<body>

    <div class="changepass-container" style=" margin: 0 auto;">
        <div style="font-family: Arial, sans-serif;">
            <div class="changepass-header">
                <h2>Change Password</h2>
            </div>

            <div class="changepass-body" style="min-height: 570px;">
                <form id="changepassForm" action="submit_change.php" method="post">

                    <div class="pass field">
                        <div class="handle">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />

                            </g>
                            </svg>
                            <p>Current Password:</p>
                        </div>
                        <div class="passwordField" data-isvisible="false">
                            <input name="password" id="loginPass" type="password" placeholder="Current Password"
                                maxlength="8" autocomplete="off" required>
                            <div class="eyeIcon open" onclick="togglePass()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path
                                            d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                        <path fill="#000000"
                                            d="M12 5c3.679 0 8.162 2.417 9.73 5.901c.146.328.27.71.27 1.099c0 .388-.123.771-.27 1.099C20.161 16.583 15.678 19 12 19s-8.162-2.417-9.73-5.901C2.124 12.77 2 12.389 2 12c0-.388.123-.771.27-1.099C3.839 7.417 8.322 5 12 5m0 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8m0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4" />
                                    </g>
                                </svg>
                            </div>
                            <div class="eyeIcon close" onclick="togglePass()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g fill="none" fill-rule="evenodd">
                                        <path
                                            d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                        <path fill="#000000"
                                            d="M2.5 9a1.5 1.5 0 0 1 2.945-.404c1.947 6.502 11.158 6.503 13.109.005a1.5 1.5 0 1 1 2.877.85a10.1 10.1 0 0 1-1.623 3.236l.96.96a1.5 1.5 0 1 1-2.122 2.12l-1.01-1.01a9.6 9.6 0 0 1-1.67.915l.243.906a1.5 1.5 0 0 1-2.897.776l-.251-.935c-.705.073-1.417.073-2.122 0l-.25.935a1.5 1.5 0 0 1-2.898-.776l.242-.907a9.6 9.6 0 0 1-1.669-.914l-1.01 1.01a1.5 1.5 0 1 1-2.122-2.12l.96-.96a10.1 10.1 0 0 1-1.62-3.23A1.5 1.5 0 0 1 2.5 9" />
                                    </g>
                                </svg>
                            </div>
                        </div>

                        <div class="pass field">
                            <div class="handle">
                                <g fill="none" fill-rule="evenodd">
                                    <path
                                        d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />

                                </g>
                                </svg>
                                <p>New Password:</p>
                            </div>
                            <div class="passwordField" data-isvisible="false">
                                <input name="password" id="loginPass" type="password" placeholder="New Password"
                                    maxlength="8" autocomplete="off" required>
                                <div class="eyeIcon open" onclick="togglePass()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path
                                                d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                            <path fill="#000000"
                                                d="M12 5c3.679 0 8.162 2.417 9.73 5.901c.146.328.27.71.27 1.099c0 .388-.123.771-.27 1.099C20.161 16.583 15.678 19 12 19s-8.162-2.417-9.73-5.901C2.124 12.77 2 12.389 2 12c0-.388.123-.771.27-1.099C3.839 7.417 8.322 5 12 5m0 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8m0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="eyeIcon close" onclick="togglePass()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <path
                                                d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                            <path fill="#000000"
                                                d="M2.5 9a1.5 1.5 0 0 1 2.945-.404c1.947 6.502 11.158 6.503 13.109.005a1.5 1.5 0 1 1 2.877.85a10.1 10.1 0 0 1-1.623 3.236l.96.96a1.5 1.5 0 1 1-2.122 2.12l-1.01-1.01a9.6 9.6 0 0 1-1.67.915l.243.906a1.5 1.5 0 0 1-2.897.776l-.251-.935c-.705.073-1.417.073-2.122 0l-.25.935a1.5 1.5 0 0 1-2.898-.776l.242-.907a9.6 9.6 0 0 1-1.669-.914l-1.01 1.01a1.5 1.5 0 1 1-2.122-2.12l.96-.96a10.1 10.1 0 0 1-1.62-3.23A1.5 1.5 0 0 1 2.5 9" />
                                        </g>
                                    </svg>
                                </div>
                            </div>

                            <div class="pass field">
                                <div class="handle">
                                    <g fill="none" fill-rule="evenodd">
                                        <path
                                            d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />

                                    </g>
                                    </svg>
                                    <p>Confirm Password:</p>
                                </div>
                                <div class="passwordField" data-isvisible="false">
                                    <input name="password" id="loginPass" type="password" placeholder="Confirm Password"
                                        maxlength="8" autocomplete="off" required>
                                    <div class="eyeIcon open" onclick="togglePass()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="#000000"
                                                    d="M12 5c3.679 0 8.162 2.417 9.73 5.901c.146.328.27.71.27 1.099c0 .388-.123.771-.27 1.099C20.161 16.583 15.678 19 12 19s-8.162-2.417-9.73-5.901C2.124 12.77 2 12.389 2 12c0-.388.123-.771.27-1.099C3.839 7.417 8.322 5 12 5m0 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8m0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="eyeIcon close" onclick="togglePass()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <g fill="none" fill-rule="evenodd">
                                                <path
                                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                <path fill="#000000"
                                                    d="M2.5 9a1.5 1.5 0 0 1 2.945-.404c1.947 6.502 11.158 6.503 13.109.005a1.5 1.5 0 1 1 2.877.85a10.1 10.1 0 0 1-1.623 3.236l.96.96a1.5 1.5 0 1 1-2.122 2.12l-1.01-1.01a9.6 9.6 0 0 1-1.67.915l.243.906a1.5 1.5 0 0 1-2.897.776l-.251-.935c-.705.073-1.417.073-2.122 0l-.25.935a1.5 1.5 0 0 1-2.898-.776l.242-.907a9.6 9.6 0 0 1-1.669-.914l-1.01 1.01a1.5 1.5 0 1 1-2.122-2.12l.96-.96a10.1 10.1 0 0 1-1.62-3.23A1.5 1.5 0 0 1 2.5 9" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit" class="submit-btn" id="post-change-btn">Change Password</button>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" id="modal-overlay">
            <div class="modal" style="font-family: Arial, sans-serif;">
                <h3>Are you sure you want to change your password?</h3>
                <div class="modal-buttons">
                    <button class="modal-btn confirm" id="confirm-btn">Yes, Change</button>
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

        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.passwordField').forEach(field => {
                const input = field.querySelector('input');
                const iconOpen = field.querySelector('.eyeIcon.open');
                const iconClose = field.querySelector('.eyeIcon.close');


                field.dataset.isvisible = 'false';


                function toggle() {
                    const isVisible = field.dataset.isvisible === 'true';

                    field.dataset.isvisible = isVisible ? 'false' : 'true';

                    input.type = isVisible ? 'password' : 'text';
                }


                iconOpen.addEventListener('click', toggle);
                iconClose.addEventListener('click', toggle);
            });


            const postBtn = document.getElementById('post-change-btn');
            const modalOverlay = document.getElementById('modal-overlay');
            const confirmBtn = document.getElementById('confirm-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            const form = document.getElementById('changepassForm');

            postBtn.addEventListener('click', e => {
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


            const idInput = document.getElementById('idInput');
            if (idInput) {
                idInput.addEventListener('input', () => {
                    const maxLen = +idInput.maxLength;
                    if (idInput.value.length > maxLen) {
                        idInput.value = idInput.value.slice(0, maxLen);
                    }
                });
            }
        });
        </script>

</body>

</html>