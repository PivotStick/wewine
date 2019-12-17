<?php


namespace App\CRUD;


use App\Entity\Wine;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class WineCRUD
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var ObjectRepository
     */
    private ObjectRepository $repo;


    /**
     * WineCRUD constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repo = $entityManager->getRepository("App:Wine");
    }

    /**
     * @param int $id
     * @return Wine
     */
    public function getOneById(int $id): Wine
    {
        return $this->repo->find($id);
    }

    /**
     * @return Wine[]|array
     */
    public function getAll(): array
    {
        return $this->repo->findAll();
    }
}