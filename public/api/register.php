<?php

use controllers\RegisterController;

require_once __DIR__ . '/../../backend/config/db.php';
require_once __DIR__ . '/../../backend/controllers/RegisterController.php';

// Create DB connection
$conn = include __DIR__ . '/../../backend/config/db.php';

$controller = new RegisterController($conn);

// Handle JSON POST data
$data = $_POST;
$response = $controller->register($data);

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);