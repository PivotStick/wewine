<?php

namespace App\CRUD;

use App\Entity\Cellar;
use App\Repository\CellarRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;


class CellarCRUD

{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CellarRepository|ObjectRepository
     *
     */
    private $repo;

    /**
     * CellarCRUD constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
        $this->repo = $em->getRepository('App:CellarCRUD');
    }

    /**
     * @param Cellar $Cellar
     */
    private function persist(Cellar $Cellar)
    {
        $this->em->persist($Cellar);
        $this->em->flush();
    }

    /**
     * @param Cellar $Cellar
     */
    public function add(Cellar $Cellar): void
    {
        $this->persist($Cellar);
    }

    /**
     * @param Cellar $Cellar
     */
    public function update(Cellar $Cellar): void
    {
        $this->persist($Cellar);

    }

    /**
     * @param Cellar $Cellar
     */
    public function delete(Cellar $Cellar): void
    {
        $this->em->remove($Cellar);
        $this->em->flush();
    }

    /**
     * @param int $id
     * @return Cellar|null
     */
    public function getOneById(int $id): ?Cellar
    {
        return $this->repo->find($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->repo->findAll();

    }
}
