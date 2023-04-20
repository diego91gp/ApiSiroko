<?php

namespace App\Shop\Domain\User;

interface UserRepository
{
    public function saveUser(User $user);

    public function deleteUser(User $user);

    public function findById(int $userId);


}