<?php

namespace App\Entity;

use App\Repository\UserHasEntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserHasEntrepriseRepository::class)]
class UserHasEntreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'Entreprise')]
    private ?Entreprise $Entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->Entreprise;
    }

    public function setEntreprise(?Entreprise $Entreprise): static
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }
}
