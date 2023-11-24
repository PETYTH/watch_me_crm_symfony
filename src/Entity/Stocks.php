<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StocksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StocksRepository::class)]
#[ApiResource]
class Stocks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_stock = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    #[ORM\Column]
    private ?int $nombre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdstock(): ?int
    {
        return $this->id_stock;
    }

    public function setIdStock(int $id_stock): static
    {
        $this->id_stock = $id_stock;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }
}
