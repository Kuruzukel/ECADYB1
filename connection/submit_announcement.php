<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to MongoDB
        $client = new Client("mongodb://localhost:27017");
        $collection = $client->mydb->announcements;

        // Get form data
        $title = trim($_POST['title'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $date = $_POST['date'] ?? '';
        $time = $_POST['time'] ?? '';

        // Validate required fields
        if (empty($title) || empty($message)) {
            throw new Exception("Title and message are required");
        }

        // Create announcement document
        $announcement = [
            'title' => $title,
            'message' => $message,
            'date' => $date,
            'time' => $time,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'status' => 'active'
        ];

        // Insert into database
        $result = $collection->insertOne($announcement);

        if ($result->getInsertedCount() > 0) {
            // Success response
            $response = [
                'success' => true,
                'message' => 'Announcement posted successfully!',
                'id' => $result->getInsertedId()
            ];
        } else {
            throw new Exception("Failed to insert announcement");
        }

    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ];
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// If not POST request, redirect to create announcement page
header('Location: CreateAnnouncement.php');
exit;
?> 