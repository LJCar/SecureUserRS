<?php

namespace repositories;

use interfaces\UserRepositoryInterface;
use mysqli;
use User;

require_once __DIR__ . '/../interfaces/UserRepositoryInterface.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository implements UserRepositoryInterface
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function save(User $user): bool
    {
        $stmt = $this->conn->prepare("
            INSERT INTO users (
                account_type,
                username,
                password_hash,
                full_name,
                contact_name,
                job_title,
                phone_number,
                email
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            error_log('Query failed: ' . $this->conn->error);
            return false;
        }

        $accountType = $user->getAccountType();
        $username = $user->getUsername();
        $passwordHash = $user->getPasswordHash();
        $fullName = $user->getFullName();
        $contactName = $user->getContactName();
        $jobTitle = $user->getJobTitle();
        $phoneNumber = $user->getPhoneNumber();
        $email = $user->getEmail();

        if (!$stmt->bind_param(
            "ssssssss",
            $accountType,
            $username,
            $passwordHash,
            $fullName,
            $contactName,
            $jobTitle,
            $phoneNumber,
            $email
        )){
            error_log('Bind failed: ' . $stmt->error);
            return false;
        };

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function usernameExists(string $username): bool
    {
        $stmt = $this->conn->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
        if (!$stmt) {
            error_log('usernameExists failed: ' . $this->conn->error);
            return false;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }

    public function emailExists(string $email): bool
    {
        $stmt = $this->conn->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
        if (!$stmt) {
            error_log('emailExists failed: ' . $this->conn->error);
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }
}