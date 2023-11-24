<?php

namespace App\Entity;

use App\Repository\ClientHasEntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientHasEntrepriseRepository::class)]
class ClientHasEntreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Client_entreprise')]
    private ?Client $Client = null;

    #[ORM\ManyToOne(inversedBy: 'Entreprise_client')]
    private ?Entreprise $Entreprise_client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): static
    {
        $this->Client = $Client;

        return $this;
    }

    public function getEntrepriseClient(): ?Entreprise
    {
        return $this->Entreprise_client;
    }

    public function setEntrepriseClient(?Entreprise $Entreprise_client): static
    {
        $this->Entreprise_client = $Entreprise_client;

        return $this;
    }
}
