<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['client_id', 'clients', 'commandes'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_nom', 'clients', 'commandes'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_prenom', 'clients', 'commandes'])]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Serializer\Groups(['client_date_naissance', 'clients'])]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_email', 'clients'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Serializer\Groups(['client_telephone', 'clients'])]
    private ?int $telephone = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_adresse', 'clients'])]
    private ?string $adresse = null;

    #[ORM\Column]
    #[Serializer\Groups(['client_code_postal', 'clients'])]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_ville', 'clients'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['client_status', 'clients'])]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'Commande_client', targetEntity: Commandes::class)]
    #[Serializer\Groups(['client_commandes', 'clients', 'commandes'])]
    private Collection $Client_commande;

    #[ORM\OneToMany(mappedBy: 'Client', targetEntity: ClientHasEntreprise::class)]
    #[Serializer\Groups(['client_entreprises', 'clients'])]
    private Collection $Client_entreprise;

    public function __construct()
    {
        $this->Client_commande = new ArrayCollection();
        $this->Client_entreprise = new ArrayCollection();
    }

    #[Serializer\Groups(['client_id', 'commandes'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['client_nom', 'commandes'])]
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    #[Serializer\Groups(['client_prenom'])]
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    #[Serializer\Groups(['client_date_naissance'])]
    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    #[Serializer\Groups(['client_email'])]
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    #[Serializer\Groups(['client_telephone'])]
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    #[Serializer\Groups(['client_adresse'])]
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    #[Serializer\Groups(['client_code_postal'])]
    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    #[Serializer\Groups(['client_ville'])]
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    #[Serializer\Groups(['client_status'])]
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    #[Serializer\Groups(['client_commandes'])]
    public function getClientCommande(): Collection
    {
        return $this->Client_commande;
    }

    public function addClientCommande(Commandes $clientCommande): static
    {
        if (!$this->Client_commande->contains($clientCommande)) {
            $this->Client_commande->add($clientCommande);
            $clientCommande->setCommandeClient($this);
        }

        return $this;
    }

    public function removeClientCommande(Commandes $clientCommande): static
    {
        if ($this->Client_commande->removeElement($clientCommande)) {
            // set the owning side to null (unless already changed)
            if ($clientCommande->getCommandeClient() === $this) {
                $clientCommande->setCommandeClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ClientHasEntreprise>
     */
    #[Serializer\Groups(['client_entreprises'])]
    public function getClientEntreprise(): Collection
    {
        return $this->Client_entreprise;
    }

    public function addClientEntreprise(ClientHasEntreprise $clientEntreprise): static
    {
        if (!$this->Client_entreprise->contains($clientEntreprise)) {
            $this->Client_entreprise->add($clientEntreprise);
            $clientEntreprise->setClient($this);
        }

        return $this;
    }

    public function removeClientEntreprise(ClientHasEntreprise $clientEntreprise): static
    {
        if ($this->Client_entreprise->removeElement($clientEntreprise)) {
            // set the owning side to null (unless already changed)
            if ($clientEntreprise->getClient() === $this) {
                $clientEntreprise->setClient(null);
            }
        }

        return $this;
    }
}
