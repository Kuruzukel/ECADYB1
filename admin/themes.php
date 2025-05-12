<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Theme Selector</title>
    <style>
    :root {
        --primary-bg: #000042;
        --header-bg: #0928c6;
        --accent: #1d2db2;
        --section-bg: #34495e;
        --section-header: #217ff7;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        width: 100%;
    }

    .container {
        width: 90%;
        max-width: 1380px;
        margin: 18px auto;
        background-color: var(--primary-bg);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        min-height: 600px;
    }

    .header-container {
        width: 100%;
        height: 65px;
        background-color: var(--header-bg);
        padding: 20px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -15px;
        border-bottom: 2px solid var(--accent);
    }

    h1 {
        margin: 0;
        color: #ffffff;
        font-size: 24px;
        width: 100%;
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
        width: 50%;
        min-width: 250px;
        background-color: var(--section-bg);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        min-height: 520px;
        display: flex;
        flex-direction: column;
        align-items: center;
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

    .color-selector {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
        width: 100%;
    }

    .color-box {
        width: 100%;
        min-width: 100px;
        height: 73px;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: transform 0.2s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: row;
    }

    .color-bar {
        flex: 1;
        width: 100%;
    }

    .color-box:hover {
        transform: scale(1.05);
    }

    .color-box.selected {
        border: 3px solid #ffffff;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.6);
    }

    .color-box::after {
        content: attr(data-label);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ffffff;
        font-size: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .color-box:hover::after {
        opacity: 1;
    }

    .color-theme1 .color-bar:nth-child(1) {
        background-color: #470a0a;
    }

    .color-theme1 .color-bar:nth-child(2) {
        background-color: #b21c0e;
    }

    .color-theme1 .color-bar:nth-child(3) {
        background-color: #cb0e40;
    }

    .color-theme1 .color-bar:nth-child(4) {
        background-color: #bc4f5e;
    }

    .color-theme1 .color-bar:nth-child(5) {
        background-color: #cb5382;
    }


    .color-theme2 .color-bar:nth-child(1) {
        background-color: #12086F;
    }

    .color-theme2 .color-bar:nth-child(2) {
        background-color: #2B35AF;
    }

    .color-theme2 .color-bar:nth-child(3) {
        background-color: #4361EE;
    }

    .color-theme2 .color-bar:nth-child(4) {
        background-color: #4895EF;
    }

    .color-theme2 .color-bar:nth-child(5) {
        background-color: #4CC9F0;
    }


    .color-theme3 .color-bar:nth-child(1) {
        background-color: #0d381e;
    }

    .color-theme3 .color-bar:nth-child(2) {
        background-color: #164f2c;
    }

    .color-theme3 .color-bar:nth-child(3) {
        background-color: #1f693c;
    }

    .color-theme3 .color-bar:nth-child(4) {
        background-color: #2a834d;
    }

    .color-theme3 .color-bar:nth-child(5) {
        background-color: #349e5e;
    }


    .color-theme4 .color-bar:nth-child(1) {
        background-color: #281E18;
    }

    .color-theme4 .color-bar:nth-child(2) {
        background-color: #572D0C;
    }

    .color-theme4 .color-bar:nth-child(3) {
        background-color: #C78E3A;
    }

    .color-theme4 .color-bar:nth-child(4) {
        background-color: #E3B76A;
    }

    .color-theme4 .color-bar:nth-child(5) {
        background-color: #FDFCD4;
    }


    .color-default .color-bar:nth-child(1) {
        background-color: #1d2db2;
    }

    .color-default .color-bar:nth-child(2) {
        background-color: #2980ef;
    }

    .color-default .color-bar:nth-child(3) {
        background-color: #3e5161;
    }

    .color-default .color-bar:nth-child(4) {
        background-color: #22354c;
    }

    .color-default .color-bar:nth-child(5) {
        background-color: #14154b;
    }

    @media (max-width: 1045px) {
        .container {
            width: 95%;
        }

        h1 {
            font-size: 1.8rem;
        }

        input {
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .form-group {
            flex-direction: column;
            height: auto;
        }

        .section {
            width: 100%;
            min-height: 350px;
            margin-bottom: 20px;
        }

        .container {
            min-height: auto;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-container">
            <h1>Appearance</h1>
        </div>
        <div class="form-content">
            <div class="form-group">
                <div class="section">
                    <div class="section-header">Themes</div>
                    <div class="section-content">
                        <div class="color-selector">
                            <div class="color-box color-theme1" data-label="Theme 1" onclick="selectColor(this)">
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                            </div>
                            <div class="color-box color-theme2" data-label="Theme 2" onclick="selectColor(this)">
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                            </div>
                            <div class="color-box color-theme3" data-label="Theme 3" onclick="selectColor(this)">
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                            </div>
                            <div class="color-box color-theme4" data-label="Theme 4" onclick="selectColor(this)">
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                            </div>
                            <div class="color-box color-default" data-label="Default" onclick="selectColor(this)">
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                                <div class="color-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">Logo Container</div>
                    <div class="section-content">
                        <div class="file-card">
                            <!-- Upload Logo or Logo Preview Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const themes = {
        "Theme 1": {
            '--primary-bg': '#470a0a',
            '--header-bg': '#b21c0e',
            '--accent': '#cb0e40',
            '--section-bg': '#bc4f5e',
            '--section-header': '#cb5382'
        },
        "Theme 2": {
            "--primary-bg": "#12086F",
            "--header-bg": "#2B35AF",
            "--accent": "#4361EE",
            "--section-bg": "#4895EF",
            "--section-header": "#4CC9F0"
        },
        "Theme 3": {
            "--primary-bg": "#0d381e",
            "--header-bg": "#164f2c",
            "--accent": "#1f693c",
            "--section-bg": "#2a834d",
            "--section-header": "#349e5e"
        },
        "Theme 4": {
            "--primary-bg": "#281E18",
            "--header-bg": "#572D0C",
            "--accent": "#C78E3A",
            "--section-bg": "#E3B76A",
            "--section-header": "#FDFCD4"
        },
        "Default": {
            "--primary-bg": "#000042",
            "--header-bg": "#0928c6",
            "--accent": "#fcda15",
            "--section-bg": "#34495e",
            "--section-header": "#217ff7"
        }
    };

    function selectColor(el) {
        document.querySelectorAll('.color-box').forEach(box => {
            box.classList.remove('selected');
        });
        el.classList.add('selected');

        const themeLabel = el.getAttribute('data-label');
        applyTheme(themeLabel);
    }

    function applyTheme(theme) {
        const root = document.documentElement;
        const selectedTheme = themes[theme] || themes["Default"];
        for (const [varName, color] of Object.entries(selectedTheme)) {
            root.style.setProperty(varName, color);
        }

        localStorage.setItem('dashboard-theme', theme);
    }

    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('dashboard-theme') || 'Default';
        applyTheme(savedTheme);
        const selectedBox = document.querySelector(`.color-box[data-label="${savedTheme}"]`);
        if (selectedBox) selectedBox.classList.add('selected');
    });
    </script>
</body>

</html>