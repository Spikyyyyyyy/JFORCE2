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
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$text = trim($_POST['feedback_text'] ?? '');

if ($id <= 0 || $text === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid feedback data']);
    exit;
}

try {
    $stmt = $pdo->prepare('UPDATE feedback SET feedback_text = :feedback_text WHERE id = :id');
    $stmt->execute([
        ':feedback_text' => $text,
        ':id' => $id
    ]);

    echo json_encode(['success' => true, 'message' => 'Feedback updated successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to update feedback: ' . $e->getMessage()]);
}
