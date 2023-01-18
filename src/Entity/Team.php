<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $shortname;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Athete::class)]
    private $athetes;

    #[ORM\ManyToOne(targetEntity: Sport::class, inversedBy: 'teams')]
    private $Sport;

    public function __construct()
    {
        $this->athetes = new ArrayCollection();
        $this->sports = new ArrayCollection();
    }

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

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Athete>
     */
    public function getAthetes(): Collection
    {
        return $this->athetes;
    }

    public function addAthete(Athete $athete): self
    {
        if (!$this->athetes->contains($athete)) {
            $this->athetes[] = $athete;
            $athete->setTeam($this);
        }

        return $this;
    }

    public function removeAthete(Athete $athete): self
    {
        if ($this->athetes->removeElement($athete)) {
            // set the owning side to null (unless already changed)
            if ($athete->getTeam() === $this) {
                $athete->setTeam(null);
            }
        }

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->Sport;
    }

    public function setSport(?Sport $Sport): self
    {
        $this->Sport = $Sport;

        return $this;
    }

}
