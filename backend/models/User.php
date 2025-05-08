<?php

class User
{
    private $accountType;
    private string $username;
    private $passwordHash;
    private ?string $fullName;
    private ?string $contactName;
    private ?string $jobTitle;
    private ?string $phoneNumber;
    private string $email;

    public function __construct(array $data) {
        $this->accountType = $data['account_type'];
        $this->username = $data['username'];
        $this->passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->fullName = $data['full_name'] ?? null;
        $this->contactName = $data['contact_name'] ?? null;
        $this->jobTitle = $data['job_title'] ?? null;
        $this->phoneNumber = $data['phone_number'] ?? null;
        $this->email = $data['email'];
    }

    // Getters
    public function getAccountType(): string { return $this->accountType; }
    public function getUsername(): string { return $this->username; }
    public function getPasswordHash(): string { return $this->passwordHash; }
    public function getFullName(): ?string { return $this->fullName; }
    public function getContactName(): ?string { return $this->contactName; }
    public function getJobTitle(): ?string { return $this->jobTitle; }
    public function getPhoneNumber(): ?string { return $this->phoneNumber; }
    public function getEmail(): string { return $this->email; }
}