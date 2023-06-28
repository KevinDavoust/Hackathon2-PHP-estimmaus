<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $valMin = null;

    #[ORM\Column(nullable: true)]
    private ?int $valMax = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValMin(): ?int
    {
        return $this->valMin;
    }

    public function setValMin(?int $valMin): static
    {
        $this->valMin = $valMin;

        return $this;
    }

    public function getValMax(): ?int
    {
        return $this->valMax;
    }

    public function setValMax(?int $valMax): static
    {
        $this->valMax = $valMax;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
