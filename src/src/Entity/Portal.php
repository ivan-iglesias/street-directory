<?php

namespace App\Entity;

use App\Repository\PortalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PortalRepository::class)]
class Portal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Street::class, inversedBy: 'portals')]
    #[ORM\JoinColumn(nullable: false)]
    private $street;

    #[ORM\Column(type: 'integer')]
    #[Groups(['portal'])]
    private $number;

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    #[Groups(['portal'])]
    private $bis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?Street
    {
        return $this->street;
    }

    public function setStreet(?Street $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getBis(): ?string
    {
        return $this->bis;
    }

    public function setBis(?string $bis): self
    {
        $this->bis = $bis;

        return $this;
    }
}
