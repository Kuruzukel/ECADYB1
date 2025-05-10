<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Announcement</title>
    <style>
    /* Your existing styles */
    .announcement-container {
        width: 90%;
        max-width: 1000px;
        margin: 35px auto;
        background-color: #000042;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
        overflow: hidden;
        margin-top: 20px;
    }

    .announcement-header {
        background-color: #0928c6;
        padding: 20px;
        text-align: center;
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
    <div class="announcement-container" style="max-width: 1500px; margin: 0 auto;">
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

    <script>
    // References to elements
    const postBtn = document.getElementById('post-announcement-btn'); // Corrected the ID
    const modalOverlay = document.getElementById('modal-overlay');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const form = document.getElementById('announcementForm');

    // Show the modal when the "Post Announcement" button is clicked
    postBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent form submission to show the modal first
        modalOverlay.style.display = 'flex';
    });

    // Hide the modal when the "Cancel" button is clicked
    cancelBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
    });

    // Submit the form when the "Yes" button is clicked
    confirmBtn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
        form.submit(); // Submit the form
    });
    </script>
</body>

</html>