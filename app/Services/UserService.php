<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }
    public function createUser($data)
    {
        $data['id'] = Str::uuid();
        return User::create($data);
    }
    public function getUserById($id)
    {
        return User::find($id);
    }
    public function updateUser($user, $data)
    {
        $user->update($data);
        return $user;
    }
    public function deleteUser($user)
    {
        $user->delete();
    }
}
?>
