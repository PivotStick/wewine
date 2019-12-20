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
     * @return object
     */
    public function getOneById(int $id): object
    {
        return $this->repo->find($id);
    }

    /**
     * @param string $mail
     * @return bool
     */
    public function hasMail(string $mail): bool
    {
        return !empty($this->repo->findBy(['mail'=>$mail]));
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