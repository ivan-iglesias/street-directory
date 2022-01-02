<?php

namespace App\Entity;

use App\Repository\StreetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StreetRepository::class)]
class Street
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['street'])]
    private $id;

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
        $this->portals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
