<?php

namespace App\CRUD;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class UserCRUD
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
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repo = $entityManager->getRepository("App:User");
    }

    /**
     * @param int $id
     * @return User
     */
    public function getOneById(int $id): User
    {
        return $this->repo->find($id);
    }

    /**
     * @param User $user
     */
    public function persist(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @param User $user
     */
    public function create(User $user)
    {
        $this->persist($user);
    }

    /**
     * @param User $user
     */
    public function update(User $user)
    {
        $this->persist($user);
    }

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }

}