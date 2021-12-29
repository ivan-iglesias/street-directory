<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Province::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    private $province;

    #[ORM\Column(type: 'string', length: 5)]
    #[Groups(['city'])]
    private $code;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['city'])]
    private $name;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Street::class, orphanRemoval: true)]
    #[Groups(['street'])]
    private $streets;

    public function __construct()
    {
        $this->streets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvince(): ?Province
    {
        return $this->province;
    }

    public function setProvince(?Province $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    /**
     * @return Collection|Street[]
     */
    public function getStreets(): Collection
    {
        return $this->streets;
    }

    public function addStreet(Street $street): self
    {
        if (!$this->streets->contains($street)) {
            $this->streets[] = $street;
            $street->setCity($this);
        }

        return $this;
    }

    public function removeStreet(Street $street): self
    {
        if ($this->streets->removeElement($street)) {
            // set the owning side to null (unless already changed)
            if ($street->getCity() === $this) {
                $street->setCity(null);
            }
        }

        return $this;
    }
}
