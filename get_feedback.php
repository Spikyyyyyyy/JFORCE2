<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $stmt = $pdo->query('SELECT f.id, f.feedback_text, DATE_FORMAT(f.created_at, "%d-%m-%Y") AS date FROM feedback f ORDER BY f.id DESC');
    $feedbacks = $stmt->fetchAll();

    echo json_encode(['success' => true, 'data' => $feedbacks]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to load feedback: ' . $e->getMessage()]);
}
