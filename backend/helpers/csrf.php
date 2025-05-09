<?php
function get_csrf_token(): string {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (empty($_SESSION['csrf_token'])) {
        try {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (Exception $e) {
            error_log("CSRF generation failed: " . $e->getMessage());
            die('Please try again later');
        }
    }

    return $_SESSION['csrf_token'];
}