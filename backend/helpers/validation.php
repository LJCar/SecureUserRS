<?php

function validateUsername(string $username): ?string {
    $username = strtolower(trim($username));

    if ($username === '') {
        return 'Username is required';
    }

    if (strlen($username) < 3 || strlen($username) > 20) {
        return 'Username must be between 3 and 20 characters';
    }

    if (preg_match('/\s/', $username)) {
        return 'Username cannot contain spaces';
    }

    if (!preg_match('/^[a-zA-Z0-9._]+$/', $username)) {
        return 'Username can only contain letters, numbers, dots, or underscores';
    }

    if (preg_match('/^[._]/', $username) || preg_match('/[._]$/', $username)) {
        return 'Username cannot start or end with a dot or underscore';
    }

    if (preg_match('/[._]{2,}/', $username)) {
        return 'Username cannot contain consecutive dots or underscores';
    }

    $reserved = ['admin', 'root', 'support', 'system', 'help', 'login', 'register'];
    if (in_array($username, $reserved)) {
        return 'This username is taken';
    }

    return null;
}

function validatePassword(string $password): ?string {

    if (strlen($password) < 8) {
        return 'Password must be at least 8 characters long';
    }

    if (strlen($password) > 64) {
        return 'Password cannot be longer than 64 characters';
    }

    if (preg_match('/\s/', $password)) {
        return 'Password cannot contain spaces';
    }

    if (
        !preg_match('/[A-Z]/i', $password) ||
        !preg_match('/\d/', $password) ||
        !preg_match('/[\W_]/', $password)
    ) {
        return 'Password must include at least one letter, one number, and one special character';
    }

    return null;
}

function validateName(string $name, string $label): ?string {
    $name = trim($name);

    if ($name === '') {
        return "$label is required.";
    }

    if (strlen($name) < 3 || strlen($name) > 50) {
        return "$label must be between 3 and 50 characters";
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        return "$label can only contain letters and spaces";
    }

    return null;
}

function cleanName(string $name): string {
    // Collapse multiple spaces and trim
    $name = preg_replace('/\s+/', ' ', trim($name));
    // Capitalize first letter of each word
    return ucwords(strtolower($name));
}

function validatePhoneNumber(string $phone): ?string {
    // Remove all non-digit characters
    $stripped = preg_replace('/\D/', '', $phone);

    // If user typed something, but it has no digits at all
    if ($phone !== '' && $stripped === '') {
        return "Phone number must contain numeric digits";
    }

    // If there are digits but too few or too many
    if ($stripped !== '' && (strlen($stripped) < 10 || strlen($stripped) > 15)) {
        return "Phone number must contain 10 to 15 digits";
    }

    return null;
}