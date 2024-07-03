<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function assignRoleToUser(User $user, string $roles): void;
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function export();
}
