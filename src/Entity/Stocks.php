<?php

namespace App\Entity;

use App\Repository\StocksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: StocksRepository::class)]
class Stocks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['stock_id', 'produits'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['stock_numero', 'produits'])]
    private ?string $numero = null;

    #[ORM\Column]
    #[Serializer\Groups(['stock_nombre', 'produits'])]
    private ?int $nombre = null;

    #[ORM\OneToMany(mappedBy: 'produit_stock', targetEntity: Produits::class)]
    #[Serializer\Groups(['stock_produit', 'produits'])]
    private Collection $Stock_produit;

    public function __construct()
    {
        $this->Stock_produit = new ArrayCollection();
    }

    #[Serializer\Groups(['stock_id', 'produits'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['stock_numero', 'produits'])]
    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    #[Serializer\Groups(['stock_nombre', 'produits'])]
    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    #[Serializer\Groups(['stock_produit', 'produits'])]
    public function getStockProduit(): Collection
    {
        return $this->Stock_produit;
    }

    public function addStockProduit(Produits $stockProduit): static
    {
        if (!$this->Stock_produit->contains($stockProduit)) {
            $this->Stock_produit->add($stockProduit);
            $stockProduit->setProduitStock($this);
        }

        return $this;
    }

    public function removeStockProduit(Produits $stockProduit): static
    {
        if ($this->Stock_produit->removeElement($stockProduit)) {
            // set the owning side to null (unless already changed)
            if ($stockProduit->getProduitStock() === $this) {
                $stockProduit->setProduitStock(null);
            }
        }

        return $this;
    }
}
