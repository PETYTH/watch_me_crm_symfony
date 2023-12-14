<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['produit_id', 'stocks', 'commandes'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['produit_nom', 'stocks', 'commandes'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Serializer\Groups(['produit_prix', 'stocks', 'commandes'])]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['produit_image', 'stocks', 'commandes'])]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'Stock_produit')]
    #[Serializer\Groups(['produit_stock', 'stocks', 'commandes'])]
    private ?Stocks $produit_stock = null;

    #[Serializer\Groups(['produit_id', 'stocks', 'commandes'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['produit_nom', 'stocks', 'commandes'])]
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    #[Serializer\Groups(['produit_prix', 'stocks', 'commandes'])]
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    #[Serializer\Groups(['produit_image', 'stocks', 'commandes'])]
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    #[Serializer\Groups(['produit_stock', 'stocks', 'commandes'])]
    public function getProduitStock(): ?Stocks
    {
        return $this->produit_stock;
    }

    public function setProduitStock(?Stocks $produit_stock): static
    {
        $this->produit_stock = $produit_stock;

        return $this;
    }
}
