<?php


namespace App\CRUD;


use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class OpinionCRUD
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ObjectRepository
     */
    private $repo;

    /**
     * OpinionCRUD constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        $this->repo = $em->getRepository('App:Opinion');
    }

    /**
     * @param Opinion $opinion
     */
    private function persist(Opinion $opinion)
    {
        $this->em->persist($opinion);
        $this->em->flush();
    }

    /**
     * @param Opinion $opinion
     */
    private function add(Opinion $opinion): void
    {
        $this->persist($opinion);
    }

    /**
     * @param Opinion $opinion
     */
    private function update(Opinion $opinion): void
    {
        $this->persist($opinion);
    }

    /**
     * @param Opinion $opinion
     */
    private function delete(Opinion $opinion): void
    {
        $this->em->remove($opinion);
        $this->em->flush();
    }

    /**
     * @param Opinion $opinion
     * @return Opinion[]|array
     */
    private function getAll(Opinion $opinion): array
    {
        return $this->repo->findAll();
    }


}