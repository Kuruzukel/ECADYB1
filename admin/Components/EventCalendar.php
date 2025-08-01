<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event Calendar</title>
    <link rel="stylesheet" href="../Assets/css/EventCalendar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container" style="font-family: Arial;">
        <div class="header-container" style="width: 100%;">
            <h1>Event Calendar</h1>
        </div>

        <div class="form-content">
            <div class="form-group">
                <!-- Event Form Section -->

                <!-- Calendar Section -->
                <div class="section">


                    <div class="calendar-container">
                        <div class="calendar-header">
                            <button class="calendar-nav" id="prev-month">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h2 id="current-month">August 2025</h2>
                            <button class="calendar-nav" id="next-month">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <div class="calendar-view-controls">
                            <button class="view-btn active" data-view="month">Month</button>
                            <button class="view-btn" data-view="week">Week</button>
                            <button class="view-btn" data-view="day">Day</button>
                            <button class="view-btn" data-view="list">List</button>
                        </div>

                        <div class="calendar-grid" id="calendar-grid">
                            <!-- Calendar will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Preview Modal -->
        <div class="modal-overlay" id="event-modal-overlay">
            <div class="modal" style="font-family: Arial, sans-serif;">
                <div class="modal-header">
                    <i class="fas fa-calendar-check modal-icon"></i>
                    <h3>Event Preview</h3>
                </div>
                <div class="modal-content">
                    <div id="event-preview-content">
                        <!-- Event preview will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-buttons">
                    <button class="modal-btn confirm" id="confirm-event-btn">
                        <i class="fas fa-check"></i>
                        Schedule Event
                    </button>
                    <button class="modal-btn cancel" id="cancel-event-btn">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="../Assets/js/EventCalendar.js"></script>
</body>

</html>