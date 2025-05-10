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

    .file-card {
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 10px auto;
        min-height: 200px;
        background-color: #34495e;
        border: 2px dashed #cbd5e0;
        transition: all 0.3s ease;
    }

    .file-card:hover {
        border-color: #2196f3;
        background-color: #34495e;
    }

    .file-card label {
        margin: 0;
        color: #fff;
        font-size: 16px;
    }

    .custom-upload {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        color: #fff;
        border: none;
        padding: 15px 35px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.2);
    }

    .custom-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
    }

    .custom-upload i {
        font-size: 20px;
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
    <div class="container" style="font-family: Arial, sans-serif; max-width: 1500px;">
        <div class="header-container" style="width: 100%;">
            <h1>Uploading Section</h1>
        </div>
        <div class="form-content" style="width: 100%;">

            <div class="form-group">
                <div class="section">
                    <div class="section-header">Top Management Message</div>
                    <div class="section-content">
                        <div class="file-card">
                            <label class="custom-upload" for="top-message"><i class="fas fa-comments"></i> Upload
                                CSV File</label>
                            <input type="file" id="top-message" class="upload-input">
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">Student Information</div>
                    <div class="section-content">
                        <div class="file-card">
                            <label class="custom-upload" for="student-info"><i class="fas fa-user-graduate"></i>
                                Upload CSV File</label>
                            <input type="file" id="student-info" class="upload-input">
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section-header">Student Photos & Templates</div>
                    <div class="section-content">
                        <div class="file-card">
                            <label class="custom-upload" for="image-upload"><i class="fas fa-image"></i> Upload
                                Image Folder</label>
                            <input type="file" id="image-upload" class="upload-input" accept="image/*">
                        </div>
                    </div>
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