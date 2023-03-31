<?php

namespace App\Repositories\Admin\Users;
use App\Models\Users;

class UsersRepository implements UsersRepositoryInterface
{

    public function allUsers()
    {
        return Users::select('email','full_name','birthday','status')->get();
    }

    public function addUser($data)
    {
        return Users::create($data);
    }

    public function getUser($id)
    {
        // TODO: Implement getUser() method.
    }

    public function updateUser($data, $id)
    {
        // TODO: Implement updateUser() method.
    }

    public function deleteUser($id)
    {
        // TODO: Implement deleteUser() method.
    }
}
