<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"mail"}, message="There is already an account with this mail")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ORM\Column(name="id", type="bigint", unique=true)
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     * @var string
     */
    private $avatar;

    /**
     * @ORM\Column(name="grade",  type="string", length=255, nullable=true)
     * @var string
     */
    private $grade;

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

    /**
     * @ORM\Column(type="json")
     * @var array
     */
    private $roles = [];


    public function __construct()
    {
        $this->listCellars = new ArrayCollection();
        $this->opinions = new ArrayCollection();

    }

    public function getId(): ?int
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

    /**
     * @see UserInterface
     */
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

    /**
     * @param string $firstname
     * @return $this
     */
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        $userName = $this->getFirstname() . " " . $this->getLastname();
        return (string) $userName;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * @return Collection|Opinion[]
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions[] = $opinion;
            $opinion->setUser($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->contains($opinion)) {
            $this->opinions->removeElement($opinion);
            // set the owning side to null (unless already changed)
            if ($opinion->getUser() === $this) {
                $opinion->setUser(null);
            }
        }

        return $this;
    }


}