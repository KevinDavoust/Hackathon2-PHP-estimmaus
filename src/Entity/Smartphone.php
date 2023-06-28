<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Memory $memory = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Storage $storage = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?State $state = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalIndice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getMemory(): ?Memory
    {
        return $this->memory;
    }

    public function setMemory(?Memory $memory): static
    {
        $this->memory = $memory;

        return $this;
    }

    public function getStorage(): ?Storage
    {
        return $this->storage;
    }

    public function setStorage(?Storage $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getTotalIndice(): ?float
    {
        return $this->totalIndice;
    }

    public function setTotalIndice(?float $totalIndice): static
    {
        $this->totalIndice = $totalIndice;

        return $this;
    }
}
