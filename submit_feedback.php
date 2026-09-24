<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Please log in first']);
    exit;
}

$feedbackText = trim($_POST['feedback_text'] ?? '');

if ($feedbackText === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Feedback is required']);
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO feedback (user_id, feedback_text) VALUES (:user_id, :feedback_text)');
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':feedback_text' => $feedbackText
    ]);

    echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to save feedback: ' . $e->getMessage()]);
}
