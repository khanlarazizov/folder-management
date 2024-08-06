<?php

namespace App\Lib\Repositories\Interfaces;

interface IUserRepository
{
    public function getAllUserWithPagination($data);

    public function getUserById($id);

    public function createUser($data);

    public function updateUser($id,$data);

    public function deleteUser($id);

    public function checkUserByEmail($email);
}
