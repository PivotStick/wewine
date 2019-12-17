<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private int $id;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @var string;
     */
    private string $mail;

    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @var string
     */
    private string $password;

    /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     * @var string
     */
    private string $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     * @var string
     */
    private string $lastname;

    /**
     * @ORM\Column(name="avatar", type="string", length=255)
     * @var string
     */
    private string $avatar;

    /**
     * @ORM\Column(name="grade",  type="string", length=255, nullable=false)
     * @var string
     */
    private string $grade;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cellar", mappedBy="owner")
     * @var ArrayCollection|Cellar[]
     */
    private $listCellars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opinion", mappedBy="user")
     * @var ArrayCollection|User[]
     */
    private $opinions;


    public function __construct()
    {
        $this->listCellars = new ArrayCollection();
        $this->opinions = new ArrayCollection();

    }

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
     * @return Collection|Cellar[]
     */
    public function getListCellars(): Collection
    {
        return $this->listCellars;
    }

    public function addListCellar(Cellar $listCellar): self
    {
        if (!$this->listCellars->contains($listCellar)) {
            $this->listCellars[] = $listCellar;
            $listCellar->setOwner($this);
        }

        return $this;
    }

    public function removeListCellar(Cellar $listCellar): self
    {
        if ($this->listCellars->contains($listCellar)) {
            $this->listCellars->removeElement($listCellar);
            // set the owning side to null (unless already changed)
            if ($listCellar->getOwner() === $this) {
                $listCellar->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cellar", mappedBy="owner")
     * @var ArrayCollection|Cellar[]
     */
    //private $idCellarList;
}