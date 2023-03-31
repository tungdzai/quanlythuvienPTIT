<?php
namespace App\Repositories\Admin\Users;
interface UsersRepositoryInterface{
    public function allUsers();
    public function addUser($data);
    public function getUser($id);
    public function updateUser($data,$id);
    public function deleteUser($id);
}
