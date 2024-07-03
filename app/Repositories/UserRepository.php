<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    function assignRoleToUser(User $user, string $roles): void
    {
        $user->assignRole($roles);
    }

    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        User::destroy($id);
    }

    public function export()
    {
        return User::select('id', 'name', 'created_at')->get();
    }
}
