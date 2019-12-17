<?php


namespace App\Controller;


use App\CRUD\WineCRUD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class WineController extends AbstractController
{

    /**
     * @Route("api/wines/{wineId}")
     *
     * @param $wineManager
     * @param $wineId
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getOneById(WineCRUD $wineManager, $wineId): JsonResponse
    {
        return new JsonResponse(
            $this->container->get("serializer")->normalize($wineManager->getOneById($wineId)),
            200,
            [
                "Access-Control-Allow-Origin" => "*"
            ]
        );
    }

    /**
     * @Route("api/wines", name="all_wines")
     *
     * @param WineCRUD $wineManager
     * @return JsonResponse
     */
    public function getAll(WineCRUD $wineManager): JsonResponse
    {
        $wines = $wineManager->getAll();
        $serializer = $this->container->get("serializer");

        $newWines = [];

        for ($i = 0; $i < count($wines); $i++)
        {
            $newWines[$i] = $serializer->normalize($wines[$i]);
        }

        return new JsonResponse(
          [
              "wineCount" => count($newWines),
              "wines" => $newWines
          ],
          200,
          [
              "Access-Control-Allow-Origin" => "*"
          ]
        );
    }
}