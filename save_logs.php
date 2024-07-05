<?php
$logFile = 'https://api.github.com/repos/roslanay/face-perception/contents/logs/logs.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = file_get_contents('php://input');
    $newLogs = json_decode($postData, true);

    if (!file_exists($logFile)) {
        // If the file doesn't exist, create it and add the new logs
        file_put_contents($logFile, json_encode($newLogs, JSON_PRETTY_PRINT));
    } else {
        // If the file exists, read the existing logs
        $existingLogs = json_decode(file_get_contents($logFile), true);
        // Append the new logs to the existing logs
        $updatedLogs = array_merge($existingLogs, $newLogs);
        // Save the updated logs back to the file
        file_put_contents($logFile, json_encode($updatedLogs, JSON_PRETTY_PRINT));
    }

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
