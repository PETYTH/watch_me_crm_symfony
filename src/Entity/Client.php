<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'Commande_client', targetEntity: Commandes::class)]
    private Collection $Client_commande;

    #[ORM\OneToMany(mappedBy: 'Client', targetEntity: ClientHasEntreprise::class)]
    private Collection $Client_entreprise;

    public function __construct()
    {
        $this->Client_commande = new ArrayCollection();
        $this->Client_entreprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

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



    /**
     * @return Collection<int, Commandes>
     */
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
