<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['commandes_id', 'clients'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Serializer\Groups(['commandes_numero', 'commandes', 'clients'])]
    private ?int $numero = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Serializer\Groups(['commandes_date', 'commandes', 'clients'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Serializer\Groups(['commandes_paiement', 'commandes', 'clients'])]
    private ?float $paiement = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['commandes_adresse', 'commandes', 'clients'])]
    private ?string $adresse = null;

    #[ORM\Column]
    #[Serializer\Groups(['commandes_code_postal', 'commandes', 'clients'])]
    private ?int $Code_postal = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['commandes_ville', 'commandes', 'clients'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['commandes_status', 'commandes', 'clients'])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'Client_commande')]
    #[Serializer\Groups(['commandes_client', 'commandes', 'clients'])]
    private ?Client $Commande_client = null;

    #[ORM\ManyToOne(targetEntity: Produits::class)]
    #[ORM\JoinColumn(name: 'produit_id', referencedColumnName: 'id')]
    #[Serializer\Groups(['commandes_produit', 'commandes', 'produits'])]
    private ?Produits $produit;



    #[Serializer\Groups(['commandes_id', 'clients'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['commandes_numero', 'commandes', 'clients'])]
    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }
    #[Serializer\Groups(['commandes_date', 'commandes', 'clients'])]
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    #[Serializer\Groups(['commandes_paiement', 'commandes', 'clients'])]
    public function getPaiement(): ?float
    {
        return $this->paiement;
    }

    public function setPaiement(float $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    #[Serializer\Groups(['commandes_adresse', 'commandes', 'clients'])]
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    #[Serializer\Groups(['commandes_code_postal', 'commandes', 'clients'])]
    public function getCodePostal(): ?int
    {
        return $this->Code_postal;
    }

    public function setCodePostal(int $Code_postal): static
    {
        $this->Code_postal = $Code_postal;

        return $this;
    }

    #[Serializer\Groups(['commandes_ville', 'commandes', 'clients'])]
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    #[Serializer\Groups(['commandes_status', 'commandes', 'clients'])]
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    #[Serializer\Groups(['commandes_client', 'commandes', 'clients'])]
    public function getCommandeClient(): ?Client
    {
        return $this->Commande_client;
    }

    #[Serializer\Groups(['commandes_client', 'commandes', 'clients'])]
    public function setCommandeClient(?Client $Commande_client): static
    {
        $this->Commande_client = $Commande_client;

        return $this;
    }

    #[Serializer\Groups(['commandes_produit', 'commandes', 'produits'])]
    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    #[Serializer\Groups(['commandes_produit', 'commandes', 'produits'])]
    public function setProduit(?Produits $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}