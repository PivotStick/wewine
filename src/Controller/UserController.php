<?php

namespace App\Controller;

use App\CRUD\UserCRUD;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("api/users/get/{userId}", name="get_user_by_id")
     * @param UserCRUD $userCRUD
     * @param $userId
     */
    public function getOneById(UserCRUD $userCRUD, int $userId)
    {

    }

    /**
     * @Route("api/users/create, name="create_user")
     * @param UserCRUD $userCRUD
     */
    public function createUser(UserCRUD $userCRUD)
    {

    }

    /**
     * @Route("api/users/update/{userId}", name="update_user")
     * @param UserCRUD $userCRUD
     * @param int $userId
     */
    public function updateUser(UserCRUD $userCRUD, int $userId)
    {

    }

    /**
     * @Route("api/users/delete/{userId}, name="delete_user")
     * @param UserCRUD $userCRUD
     * @param int $userId
     */
    public function deleteUser(UserCRUD $userCRUD, int $userId)
    {

    }
}