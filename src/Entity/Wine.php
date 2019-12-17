<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Wine
 *
 * @ORM\Entity(repositoryClass="App\Repository\WineRepository")
 * @ORM\Table(name="wine")
 *
 * @package App\Entity
 */
class Wine
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(name="domain", type="string", length=255, nullable=false)
     * @var string
     */
    private string $domain;

    /**
     * @ORM\Column(name="vintage", type="string", length=5, nullable=false)
     * @var string
     */
    private string $vintage;

    /**
     * @ORM\Column(name="description", type="text", nullable=false)
     * @var string
     */
    private string $description;


    //private $cave;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getVintage(): ?string
    {
        return $this->vintage;
    }

    public function setVintage(string $vintage): self
    {
        $this->vintage = $vintage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}