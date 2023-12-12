<?php

namespace App\Entity;

use App\Repository\ClientHasEntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: ClientHasEntrepriseRepository::class)]
class ClientHasEntreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['client_entreprise_id', 'clients'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Client_entreprise')]
    #[Serializer\Groups(['client_entreprise_client', 'clients'])]
    private ?Client $Client = null;

    #[ORM\ManyToOne(inversedBy: 'Entreprise_client')]
    #[Serializer\Groups(['client_entreprise_entreprise', 'entreprises'])]
    private ?Entreprise $Entreprise_client = null;

    #[Serializer\Groups(['client_entreprise_id', 'clients'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['client_entreprise_client', 'clients'])]
    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): static
    {
        $this->Client = $Client;

        return $this;
    }

    #[Serializer\Groups(['client_entreprise_entreprise', 'entreprises'])]
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
