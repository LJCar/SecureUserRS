<?php

use controllers\RegisterController;

require_once __DIR__ . '/../../backend/config/db.php';
require_once __DIR__ . '/../../backend/controllers/RegisterController.php';

// Create DB connection
$conn = include __DIR__ . '/../../backend/config/db.php';

session_start();

// === CSRF Token Validation ===
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'errors' => ['general' => 'Please refresh the page and try again']
    ]);
    exit;
}

$controller = new RegisterController($conn);

// Handle JSON POST data
$data = $_POST;
$response = $controller->register($data);

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);

// If registration was successful, destroy the CSRF token
if ($response['success']) {
    unset($_SESSION['csrf_token']);
    session_regenerate_id(true);
}