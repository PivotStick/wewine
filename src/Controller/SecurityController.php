<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="app_login", methods={"POST", "GET"})
     * @return JsonResponse
     */
    public function login()
    {
        $data = [];
        $error = false;
        $msg_error = "";


        return new JsonResponse(
            [
                'data' => $data,
                'error' => $error,
                'msg' => $msg_error
            ],
            200,
            [
                'Access-Control-Allow-Headers' => '*',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }

    /**
     * @Route("/logout", name="app_logout")
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
