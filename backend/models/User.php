<?php

class User
{
    private $accountType;
    private $username;
    private $passwordHash;
    private $fullName;
    private $contactName;
    private $jobTitle;
    private $phoneNumber;
    private $email;

    public function __construct(array $data) {
        $this->accountType = $data['account_type'];
        $this->username = trim($data['username']);
        $this->passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->fullName = isset($data['full_name']) ? trim($data['full_name']) : null;
        $this->contactName = isset($data['contact_name']) ? trim($data['contact_name']) : null;
        $this->jobTitle = isset($data['job_title']) ? trim($data['job_title']) : null;
        $this->phoneNumber = isset($data['phone_number']) ? trim($data['phone_number']) : null;
        $this->email = trim($data['email']);
    }

    public function getAccountType(): string { return $this->accountType; }
    public function getUsername(): string { return $this->username; }
    public function getPasswordHash(): string { return $this->passwordHash; }
    public function getFullName(): ?string { return $this->fullName; }
    public function getContactName(): ?string { return $this->contactName; }
    public function getJobTitle(): ?string { return $this->jobTitle; }
    public function getPhoneNumber(): ?string { return $this->phoneNumber; }
    public function getEmail(): string { return $this->email; }
}