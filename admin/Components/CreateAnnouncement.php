<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Announcement</title>
    <link rel="stylesheet" href="../Assets/css/CreateAnnouncement.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container" style="font-family: Arial;">
        <div class="header-container" style="width: 100%;">
            <h1>Create Announcement</h1>
        </div>

        <div class="form-content">
            <form id="announcementForm" action="submit_announcement.php" method="post">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter announcement title" required />

                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Write your announcement here..." required></textarea>
                <div class="char-counter">
                    <span id="char-count">0</span> characters
                </div>

                <label for="date">Date (optional)</label>
                <input type="date" id="date" name="date" />

                <label for="time">Time (optional)</label>
                <input type="time" id="time" name="time" />

                <div class="form-actions">
                    <button type="button" class="btn-secondary" id="preview-btn">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button type="submit" class="btn-primary" id="post-announcement-btn">
                        <i class="fas fa-paper-plane"></i>
                        Post Announcement
                    </button>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" id="modal-overlay">
            <div class="modal" style="font-family: Arial, sans-serif;">
                <div class="modal-header">
                    <i class="fas fa-question-circle modal-icon"></i>
                    <h3>Confirm Post</h3>
                </div>
                <div class="modal-content">
                    <p>Are you sure you want to post this announcement?</p>
                </div>
                <div class="modal-buttons">
                    <button class="modal-btn confirm" id="confirm-btn">
                        <i class="fas fa-check"></i>
                        Yes, Post
                    </button>
                    <button class="modal-btn cancel" id="cancel-btn">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="../Assets/js/CreateAnnouncement.js"></script>
</body>

</html>