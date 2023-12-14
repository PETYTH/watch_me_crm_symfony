<?php

namespace App\Entity;

use App\Entity\Client;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(['entreprise_id', 'clients', 'commandes', 'employes'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['entreprise_nom', 'clients', 'commandes', 'employes'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Serializer\Groups(['entreprise_numero_siret', 'clients', 'commandes', 'employes'])]
    private ?int $numero_siret = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['entreprise_adresse', 'clients', 'commandes', 'employes'])]
    private ?string $adresse = null;

    #[ORM\Column]
    #[Serializer\Groups(['entreprise_code_postal', 'clients', 'commandes', 'employes'])]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(['entreprise_ville', 'clients', 'commandes', 'employes'])]
    private ?string $ville = null;

    #[ORM\Column]
    #[Serializer\Groups(['entreprise_chiffre_affaire', 'clients', 'commandes', 'employes'])]
    private ?int $chiffre_affaire = null;


    #[ORM\OneToMany(mappedBy: 'Employes_entreprise', targetEntity: Employes::class)]
    #[Serializer\Groups(['entreprise_employes', 'clients', 'commandes', 'employes'])]
    private Collection $Employes_entreprise;


    #[ORM\OneToMany(mappedBy: "entreprise", targetEntity: Client::class)]
    #[Serializer\Groups(['entreprise_employes', 'clients', 'commandes', 'employes'])]
    private Collection $clients;


    public function __construct()
    {
        $this->Employes_entreprise = new ArrayCollection();
    }

    #[Serializer\Groups(['entreprise_id', 'clients', 'commandes', 'employes'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Serializer\Groups(['entreprise_nom', 'clients', 'commandes', 'employes'])]
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    #[Serializer\Groups(['entreprise_numero_siret', 'clients', 'commandes', 'employes'])]
    public function getNumeroSiret(): ?int
    {
        return $this->numero_siret;
    }

    public function setNumeroSiret(int $numero_siret): static
    {
        $this->numero_siret = $numero_siret;

        return $this;
    }

    #[Serializer\Groups(['entreprise_adresse', 'clients', 'commandes', 'employes'])]
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    #[Serializer\Groups(['entreprise_code_postal', 'clients', 'commandes', 'employes'])]
    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    #[Serializer\Groups(['entreprise_ville', 'clients', 'commandes', 'employes'])]
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    #[Serializer\Groups(['entreprise_chiffre_affaire', 'clients', 'commandes', 'employes'])]
    public function getChiffreAffaire(): ?int
    {
        return $this->chiffre_affaire;
    }

    public function setChiffreAffaire(int $chiffre_affaire): static
    {
        $this->chiffre_affaire = $chiffre_affaire;

        return $this;
    }

    public function getClients(): Collection
    {
        return $this->clients;
    }


    /**
     * @return Collection<int, Employes>
     */
    #[Serializer\Groups(['entreprise_employes', 'clients', 'commandes', 'employes'])]
    public function getEmployesEntreprise(): Collection
    {
        return $this->Employes_entreprise;
    }

    public function addEmployesEntreprise(Employes $employesEntreprise): static
    {
        if (!$this->Employes_entreprise->contains($employesEntreprise)) {
            $this->Employes_entreprise->add($employesEntreprise);
            $employesEntreprise->setEmployesEntreprise($this);
        }

        return $this;
    }

    public function removeEmployesEntreprise(Employes $employesEntreprise): static
    {
        if ($this->Employes_entreprise->removeElement($employesEntreprise)) {
            // set the owning side to null (unless already changed)
            if ($employesEntreprise->getEmployesEntreprise() === $this) {
                $employesEntreprise->setEmployesEntreprise(null);
            }
        }

        return $this;
    }
}