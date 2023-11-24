<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $numero_siret = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $chiffre_affaire = null;

    #[ORM\OneToMany(mappedBy: 'Entreprise', targetEntity: UserHasEntreprise::class)]
    private Collection $Entreprise;

    #[ORM\OneToMany(mappedBy: 'Employes_entreprise', targetEntity: Employes::class)]
    private Collection $Employes_entreprise;

    #[ORM\OneToMany(mappedBy: 'Entreprise_client', targetEntity: ClientHasEntreprise::class)]
    private Collection $Entreprise_client;





    public function __construct()
    {
        $this->Entreprise = new ArrayCollection();
        $this->Employes_entreprise = new ArrayCollection();
        $this->Entreprise_client = new ArrayCollection();
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

    public function getNumeroSiret(): ?int
    {
        return $this->numero_siret;
    }

    public function setNumeroSiret(int $numero_siret): static
    {
        $this->numero_siret = $numero_siret;

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

    public function getChiffreAffaire(): ?int
    {
        return $this->chiffre_affaire;
    }

    public function setChiffreAffaire(int $chiffre_affaire): static
    {
        $this->chiffre_affaire = $chiffre_affaire;

        return $this;
    }

    /**
     * @return Collection<int, UserHasEntreprise>
     */
    public function getEntreprise(): Collection
    {
        return $this->Entreprise;
    }

    public function addEntreprise(UserHasEntreprise $entreprise): static
    {
        if (!$this->Entreprise->contains($entreprise)) {
            $this->Entreprise->add($entreprise);
            $entreprise->setEntreprise($this);
        }

        return $this;
    }

    public function removeEntreprise(UserHasEntreprise $entreprise): static
    {
        if ($this->Entreprise->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getEntreprise() === $this) {
                $entreprise->setEntreprise(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection<int, Employes>
     */
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

    /**
     * @return Collection<int, ClientHasEntreprise>
     */
    public function getEntrepriseClient(): Collection
    {
        return $this->Entreprise_client;
    }

    public function addEntrepriseClient(ClientHasEntreprise $entrepriseClient): static
    {
        if (!$this->Entreprise_client->contains($entrepriseClient)) {
            $this->Entreprise_client->add($entrepriseClient);
            $entrepriseClient->setEntrepriseClient($this);
        }

        return $this;
    }

    public function removeEntrepriseClient(ClientHasEntreprise $entrepriseClient): static
    {
        if ($this->Entreprise_client->removeElement($entrepriseClient)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseClient->getEntrepriseClient() === $this) {
                $entrepriseClient->setEntrepriseClient(null);
            }
        }

        return $this;
    }

}
