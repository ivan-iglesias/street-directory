<?php

namespace App\Entity;

use App\Repository\StreetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StreetRepository::class)]
class Street
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'uuid', unique: true)]
    #[Groups(['street'])]
    private $uuid;

    #[ORM\ManyToOne(targetEntity: City::class, inversedBy: 'streets')]
    #[ORM\JoinColumn(nullable: false)]
    private $city;

    #[ORM\ManyToOne(targetEntity: Thoroughfare::class, fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['thoroughfare'])]
    private $thoroughfare;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['street'])]
    private $name;

    #[ORM\OneToMany(mappedBy: 'street', targetEntity: Portal::class, orphanRemoval: true)]
    #[Groups(['portal'])]
    private $portals;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->portals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getThoroughfare(): ?Thoroughfare
    {
        return $this->thoroughfare;
    }

    public function setThoroughfare(?Thoroughfare $thoroughfare): self
    {
        $this->thoroughfare = $thoroughfare;

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
     * @return Collection|Portal[]
     */
    public function getPortals(): Collection
    {
        return $this->portals;
    }

    public function addPortal(Portal $portal): self
    {
        if (!$this->portals->contains($portal)) {
            $this->portals[] = $portal;
            $portal->setStreet($this);
        }

        return $this;
    }

    public function removePortal(Portal $portal): self
    {
        if ($this->portals->removeElement($portal)) {
            // set the owning side to null (unless already changed)
            if ($portal->getStreet() === $this) {
                $portal->setStreet(null);
            }
        }

        return $this;
    }
}
