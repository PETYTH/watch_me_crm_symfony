<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EmployesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployesRepository::class)]
#[ApiResource]
class Employes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idEmploye = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'employes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?entreprise $employes_id_entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmploye(): ?int
    {
        return $this->idEmploye;
    }

    public function setIdEmploye(int $idEmploye): static
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getEmployesIdEntreprise(): ?entreprise
    {
        return $this->employes_id_entreprise;
    }

    public function setEmployesIdEntreprise(?entreprise $employes_id_entreprise): static
    {
        $this->employes_id_entreprise = $employes_id_entreprise;

        return $this;
    }
}
