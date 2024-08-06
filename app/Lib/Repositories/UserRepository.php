<?php

namespace App\Lib\Repositories;

use App\Lib\Repositories\Interfaces\IUserRepository;
use App\Models\User;

class UserRepository implements IUserRepository
{
    public function getAllUserWithPagination($data)
    {
        return User::name($data['name'])->paginate(5);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function createUser($data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password)
        ]);
    }

    public function updateUser($id, $data)
    {
        $user = User::find($id);
        return $user->update([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password)
        ]);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
    }

    public function checkUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
