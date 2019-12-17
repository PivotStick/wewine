<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ORM\Column(name="id", type="bigint")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @var string;
     */
    private $mail;

    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(name="avatar", type="string", length=255)
     * @var string
     */
    private $avatar;

    /**
     * @ORM\Column(name="grade",  type="string", length=255, nullable=false)
     * @var string
     */
    private $grade;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cellar", mappedBy="owner")
     * @var ArrayCollection|Cellar[]
     */
    //private $idCellarList;
}