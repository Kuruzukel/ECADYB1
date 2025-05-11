<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        width: 32%;
        min-width: 250px;
        background-color: #34495e;
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
            <h1>Choose Template</h1>
        </div>
        <div class="form-content" style="width: 100%;">

            <div class="form-group">
                <div class="section">
                    <div class="section-header">Template 1</div>
                    <div class="section-content">
                        <div class="file-card">

                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">Template 2</div>
                    <div class="section-content">
                        <div class="file-card">

                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">Template 3</div>
                    <div class="section-content">
                        <div class="file-card">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>
</div>

</html>