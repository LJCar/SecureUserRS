<?php

namespace interfaces;

use User;

interface UserRepositoryInterface
{
    public function save(User $user): bool;

    public function usernameExists(string $username): bool;

    public function emailExists(string $email): bool;
}