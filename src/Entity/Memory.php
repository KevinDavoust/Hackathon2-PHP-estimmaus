<?php

namespace App\Entity;

use App\Repository\MemoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemoryRepository::class)]
class Memory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\OneToMany(mappedBy: 'memory', targetEntity: Smartphone::class)]
    private Collection $smartphones;

    #[ORM\OneToOne(targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $indicator = null;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection<int, Smartphone>
     */
    public function getSmartphones(): Collection
    {
        return $this->smartphones;
    }

    public function addSmartphone(Smartphone $smartphone): static
    {
        if (!$this->smartphones->contains($smartphone)) {
            $this->smartphones->add($smartphone);
            $smartphone->setMemory($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getMemory() === $this) {
                $smartphone->setMemory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->getSize();
    }

    public function getIndicator(): ?self
    {
        return $this->indicator;
    }

    public function setIndicator(?self $indicator): static
    {
        $this->indicator = $indicator;

        return $this;
    }
}
