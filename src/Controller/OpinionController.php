<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OpinionController extends AbstractController
{
    /**
     * @Route("api/opinions/create", name="create_opinions")
     * @return JsonResponse
     */
    public function create()
    {
        return new JsonResponse(

        );

    }

    /**
     * @Route("api/opinions/update", name="update_opinions")
     * @return JsonResponse
     */
    public function update()
    {
        return new JsonResponse(

        );

    }

    /**
     * @Route("api/opinions/delete", name="delete")
     * @return JsonResponse
     */
    public function delete()
    {
        return new JsonResponse(

        );
    }

    /**
     * @Route("api/opinions", name="all_opinions")
     * @return JsonResponse
     */
    public function getAll()
    {
        return new JsonResponse(

        );
    }
}