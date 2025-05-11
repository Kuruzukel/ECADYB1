<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Details</title>
    <style>
    .body {
        width: 100%;
    }

    .container {
        width: 90%;
        max-width: 1000px;
        margin: 18px auto;
        background-color: #000042;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        min-height: 600px;
    }

    .header-container {
        width: 100%;
        height: 65px;
        background-color: #0928c6;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -15px;
        border-bottom: 2px solid #fcda15;
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
        background-color: #34495e;
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
        background-color: #217ff7;
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
        justify-content: center;/ align-items: center;
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

    /* RED THEME */
    .color-red .color-bar:nth-child(1) {
        background-color: #ff6b6b;
    }

    .color-red .color-bar:nth-child(2) {
        background-color: #e74c3c;
    }

    .color-red .color-bar:nth-child(3) {
        background-color: #c0392b;
    }

    .color-red .color-bar:nth-child(4) {
        background-color: #a93226;
    }

    .color-red .color-bar:nth-child(5) {
        background-color: #7b241c;
    }

    /* BLUE THEME */
    .color-blue .color-bar:nth-child(1) {
        background-color: #3498db;
    }

    .color-blue .color-bar:nth-child(2) {
        background-color: #2980b9;
    }

    .color-blue .color-bar:nth-child(3) {
        background-color: #2471a3;
    }

    .color-blue .color-bar:nth-child(4) {
        background-color: #1f618d;
    }

    .color-blue .color-bar:nth-child(5) {
        background-color: #154360;
    }

    /* GREEN THEME */
    .color-green .color-bar:nth-child(1) {
        background-color: #2ecc71;
    }

    .color-green .color-bar:nth-child(2) {
        background-color: #27ae60;
    }

    .color-green .color-bar:nth-child(3) {
        background-color: #229954;
    }

    .color-green .color-bar:nth-child(4) {
        background-color: #1e8449;
    }

    .color-green .color-bar:nth-child(5) {
        background-color: #145a32;
    }

    /* YELLOW THEME */
    .color-yellow .color-bar:nth-child(1) {
        background-color: #f9e79f;
    }

    .color-yellow .color-bar:nth-child(2) {
        background-color: #f7dc6f;
    }

    .color-yellow .color-bar:nth-child(3) {
        background-color: #f1c40f;
    }

    .color-yellow .color-bar:nth-child(4) {
        background-color: #d4ac0d;
    }

    .color-yellow .color-bar:nth-child(5) {
        background-color: #b7950b;
    }

    /* DEFAULT THEME (screenshot-like) */
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
    <div class="container" style="font-family: Arial, sans-serif; max-width: 1500px;">
        <div class="header-container" style="width: 100%;">
            <h1>Appearance</h1>
        </div>
        <div class="form-content" style="width: 100%;">
            <div class="form-group">
                <div class="section">
                    <div class="section-header">Themes</div>
                    <div class="section-content">
                        <div class="file-card">
                            <div class="color-selector">
                                <div class="color-box color-red" data-label="Red" onclick="selectColor(this)">
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                </div>
                                <div class="color-box color-blue" data-label="Blue" onclick="selectColor(this)">
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                </div>
                                <div class="color-box color-green" data-label="Green" onclick="selectColor(this)">
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                    <div class="color-bar"></div>
                                </div>
                                <div class="color-box color-yellow" data-label="Yellow" onclick="selectColor(this)">
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
                </div>

                <div class="section">
                    <div class="section-header">Logo Container</div>
                    <div class="section-content">
                        <div class="file-card">
                            <!-- Logo upload or preview goes here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function selectColor(el) {
        document.querySelectorAll('.color-box').forEach(box => {
            box.classList.remove('selected');
        });
        el.classList.add('selected');
    }
    </script>
</body>

</html>