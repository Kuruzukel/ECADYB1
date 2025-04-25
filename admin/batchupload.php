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
        margin: 20px auto;
        background-color: #000042;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        height: auto;
        min-height: 600px;
        margin: 35px auto;
    }

    .header-container {
        width: 100%;
        height: 50px;
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
        width: 100%;
        max-width: 600px;
        padding: 25px;
        box-sizing: border-box;
        height: calc(100% - 80px);
        /* Remove auto centering */
        margin-left: 0;
    }



    .form-group {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 25px;
        height: calc(100% - 100px);
    }

    .section {
        width: 20%;
        min-width: 219px;
        background-color: #34495e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        height: 100%;
        min-height: 500px;
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
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    label {
        display: block;
        width: 100%;
        margin: 12px 0 6px;
        color: #e0e0e0;
    }

    .file-card {
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 187.5px;
        margin: 10px auto 0 auto;
        min-height: 60px;
    }

    .file-card label {
        margin: 0;
        color: #fff;
        font-size: 16px;
    }

    .custom-upload {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 30px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        min-height: 40px;
    }

    .custom-upload:hover {
        background-color: #45a049;
    }

    .upload-input {
        display: none;
    }

    .file-card i {
        font-size: 18px;
        color: #fff;
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
        <div style="font-family: Arial, sans-serif;">
            <div class="header-container">
                <h1>Uploading Section</h1>
            </div>
            <div class="form-content">
                <div class="form-group">
                    <div class="section">
                        <div class="section-header">Top Management Message</div>
                        <div class="section-content">
                            <div class="file-card">
                                <label class="custom-upload" for="top-message"><i class="fas fa-comments"></i> Upload
                                    File</label>
                                <input type="file" id="top-message" class="upload-input">
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-header">Student Information</div>
                        <div class="section-content">
                            <div class="file-card">
                                <label class="custom-upload" for="student-info"><i class="fas fa-user-graduate"></i>
                                    Upload File</label>
                                <input type="file" id="student-info" class="upload-input">
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section-header">Images</div>
                        <div class="section-content">
                            <div class="file-card">
                                <label class="custom-upload" for="image-upload"><i class="fas fa-image"></i> Upload
                                    Image</label>
                                <input type="file" id="image-upload" class="upload-input" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section-header">Templates</div>
                        <div class="section-content">
                            <div class="file-card">
                                <label class="custom-upload" for="template-upload"><i class="fas fa-file-upload"></i>
                                    Upload File</label>
                                <input type="file" id="template-upload" class="upload-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</div>

</html>