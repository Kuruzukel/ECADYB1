<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Details</title>
    <style>
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
        min-height: 400px;
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

    input,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #f0f0f0;
        margin-bottom: 12px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .submit-btn {
        width: 200px;
        height: 45px;
        display: block;
        margin: 35px auto 0;
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

    @media (max-width: 768px) {
        .form-group {
            flex-direction: column;
        }

        .section {
            width: 100%;
            margin-bottom: 20px;
        }
    }

    /* MODAL STYLES */
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

    .modal h2 {
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
    </style>
</head>

<body>
    <div class="container" style="font-family: Arial, sans-serif;">
        <div class="header-container">
            <h1>Add Student Details</h1>
        </div>
        <div class="form-content">
            <div class="form-group">
                <div class="section">
                    <div class="section-header">Personal Information</div>
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" placeholder="First Name">

                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" placeholder="Middle Name">

                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" placeholder="Last Name">
                </div>

                <div class="section">
                    <div class="section-header">Academic Information</div>

                    <label for="academic-year">Academic Year:</label>
                    <input type="text" id="academic-year" placeholder="Academic Year">

                    <label for="Program">Program:</label>
                    <input type="text" id="program" placeholder="Program">

                    <label for="section">Section:</label>
                    <input type=" text" id="section" placeholder="Section">


                    <label for="section">Student ID:</label>
                    <input type="text" id="student-id" placeholder="Student ID">

                </div>

                <div class="section">
                    <div class="section-header">Additional Information</div>
                    <label for="personal-philosophy">Personal Philosophy:</label>
                    <input type="text" id="personal-philosopjy" placeholder="Personal Philosophy">

                    <label for="latin-awards">Latin Awards:</label>
                    <input type="text" id="latin-awards" placeholder="Latin Awards">

                    <label for="career-highlights">Career Highlights:</label>
                    <input type="text" id="career-highlights" placeholder="Career Highlights">

                </div>
            </div>
            <button class="submit-btn" id="add-student-btn">Add Student</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal" style="font-family: Arial, sans-serif;">
            <h2>Are you sure you want to add this student?</h2>
            <div class="modal-buttons">
                <button class="modal-btn confirm" id="confirm-btn">Yes, Add</button>
                <button class="modal-btn cancel" id="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    const addBtn = document.getElementById('add-student-btn');
    const modalOverlay = document.getElementById('modal-overlay');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');

    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modalOverlay.style.display = 'flex';
    });

    cancelBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
    });

    confirmBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
        alert("Student successfully added!");
        // Here, you can submit the form or process the data.
    });
    </script>
</body>

</html>