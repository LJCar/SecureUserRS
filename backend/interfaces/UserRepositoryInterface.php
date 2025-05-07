<?php

namespace interfaces;

use User;

interface UserRepositoryInterface
{
    public function save(User $user): bool;
}