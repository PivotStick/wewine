<?php

namespace App\Controller;

use App\CRUD\UserCRUD;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("api/users/get/{userId}", name="get_user_by_id")
     * @param $userCrud
     * @param $userId
     */
    public function getOneById(UserCRUD $userCrud, int $userId)
    {

    }

    /**
     * @Route("api/users/create, name="create_user")
     * @param UserCRUD $userCrud
     */
    public function createUser(UserCRUD $userCrud)
    {

    }

    /**
     * @Route("api/users/update/{userId}", name="update_user")
     * @param UserCRUD $userCrud
     * @param int $userId
     */
    public function updateUser(UserCRUD $userCrud, int $userId)
    {

    }

    /**
     * @Route("api/users/delete/{userId}, name="delete_user")
     * @param UserCRUD $userCrud
     * @param int $userId
     */
    public function deleteUser(UserCRUD $userCrud, int $userId)
    {

    }
}