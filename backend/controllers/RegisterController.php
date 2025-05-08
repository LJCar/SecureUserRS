<?php

namespace controllers;

use mysqli;
use repositories\UserRepository;
use User;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../helpers/validation.php';

class RegisterController
{
    private UserRepository $repo;
    public function __construct(mysqli $conn)
    {
        $this->repo = new UserRepository($conn);
    }

    public function register(array $data): array
    {
        $errors = [
            'username' => '',
            'email' => '',
            'password' => '',
            'account_type' => '',
            'full_name' => '',
            'contact_name' => '',
            'job_title' => '',
            'phone_number' => ''
        ];

        // Username validation
        $usernameError = validateUsername($data['username']);
        if ($usernameError) {
            $errors['username'] = $usernameError;
        } elseif ($this->repo->usernameExists($data['username'])) {
            $errors['username'] = 'Username already exists';
        } else {
            $data['username'] = trim($data['username']);
        }

        // Email validation
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        } elseif ($this->repo->emailExists($data['email'])) {
            $errors['email'] = 'Email already exists';
        } else {
            $data['email'] = strtolower(trim($data['email']));
        }

        //Password validation
        $passwordError = validatePassword($data['password']);
        if ($passwordError) {
            $errors['password'] = $passwordError;
        }

        // Account type validation
        if (!in_array($data['accountType'], ['Individual', 'Company'])) {
            $errors['account_type'] = 'Please select a valid account type.';
        } elseif ($data['accountType'] === 'Individual') {
            // Validate full name
            $fullNameError = validateName($data['full_name'], 'Full Name');
            if ($fullNameError) {
                $errors['full_name'] = $fullNameError;
            } else {
                $data['full_name'] = cleanName($data['full_name']);
            }
        } elseif ($data['accountType'] === 'Company') {
            // Validate contact name
            $contactNameError = validateName($data['contact_name'], 'Contact Name');
            if ($contactNameError) {
                $errors['contact_name'] = $contactNameError;
            } else {
                $data['contact_name'] = cleanName($data['contact_name']);
            }

            // Validate job title
            $jobTitleError = validateName($data['job_title'], 'Job Title');
            if ($jobTitleError) {
                $errors['job_title'] = $jobTitleError;
            } else {
                $data['job_title'] = cleanName($data['job_title']);
            }
        }

        // Validate phone number
        $phoneError = validatePhoneNumber($data['phone_number']);
        if ($phoneError) {
            $errors['phone_number'] = $phoneError;
        } else {
            $stripped = preg_replace('/\D/', '', $data['phone_number']);
            $data['phone_number'] = $stripped !== '' ? $stripped : null;
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Save User
        $user = new User($data);
        $success = $this->repo->save($user);

        return ['success' => $success, 'errors' => $success ? [] : ['Failed to save user']];
    }
}