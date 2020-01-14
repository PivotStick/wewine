<?php
namespace App\Controller;

use App\Repository\CellarRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class CellarController extends AbstractController
{


    /**
     * @Route("/api/cellar", name="app_cellar")
     * @param Request $request
     * @param CellarRepository $cellarRepository
     * @param UserRepository $repo
     * @return JsonResponse
     */
    public function getAllById(Request $request, CellarRepository $cellarRepository, UserRepository $repo) {

        $requestData = json_decode($request->getContent(), true);

        dump($requestData);

        return new JsonResponse(
            [
                'dataCellar' => $requestData[1],
            ],
            200,
            [
                'Access-Control-Allow-Headers' => '*',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
    }


}