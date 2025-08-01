<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;

header('Content-Type: application/json');

try {
    // Connect to MongoDB
    $client = new Client("mongodb://localhost:27017");
    $collection = $client->mydb->announcements;

    // Get all active announcements
    $cursor = $collection->find(['status' => 'active']);

    $announcements = [];
    foreach ($cursor as $document) {
        $announcements[] = [
            'id' => (string)$document['_id'],
            'title' => $document['title'],
            'message' => $document['message'],
            'date' => $document['date'],
            'time' => $document['time'],
            'created_at' => $document['created_at']->toDateTime()->format('Y-m-d H:i:s'),
            'type' => 'announcement'
        ];
    }

    echo json_encode([
        'success' => true,
        'announcements' => $announcements
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?> 