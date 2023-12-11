<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployesRepository::class)]
class Employes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Status = null;

    #[ORM\ManyToOne(inversedBy: 'Employes_entreprise')]
    #[Groups(["employe"])]
    private ?Entreprise $Employes_entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getEmployesEntreprise(): ?Entreprise
    {
        return $this->Employes_entreprise;
    }

    public function setEmployesEntreprise(?Entreprise $Employes_entreprise): static
    {
        $this->Employes_entreprise = $Employes_entreprise;

        return $this;
    }
}
