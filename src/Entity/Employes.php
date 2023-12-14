<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: EmployesRepository::class)]
class Employes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['employes_id', 'entreprises'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['employes_status', 'employes'])]
    private ?string $Status = null;

    #[ORM\ManyToOne(inversedBy: 'Employes_entreprise')]
    #[Serializer\Groups(['employes_entreprise', 'entreprises'])]
    private ?Entreprise $Employes_entreprise = null;

    #[Serializer\Groups(['employes_id', 'entreprises'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['employes_status', 'employes'])]
    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    #[Serializer\Groups(['employes_entreprise', 'entreprises'])]
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
