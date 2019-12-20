<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Opinion
 * @ORM\Table(name="opinion")
 * @ORM\Entity(repositoryClass="App\Repository\OpinionRepository")
 */
class Opinion
{


    //private $id_bottle;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="content", type="text", length=1500)
     * @var string
     */
    private $content;

    /**
     * @ORM\Column(name="rating", type="integer", nullable=false)
     * @var int
     */
    private $rating;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="opinions")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     * @var User
     */
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}