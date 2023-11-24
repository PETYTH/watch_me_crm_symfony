<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ApiResource]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_entreprise = null;

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

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?userhasentreprise $Entreprise_id_Entreprise = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: ClientHasEntreprise::class)]
    private Collection $entreprise_id_client;

    #[ORM\OneToMany(mappedBy: 'employes_id_entreprise', targetEntity: Employes::class)]
    private Collection $employes;

    public function __construct()
    {
        $this->entreprise_id_client = new ArrayCollection();
        $this->employes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEntreprise(): ?int
    {
        return $this->id_entreprise;
    }

    public function setIdEntreprise(int $id_entreprise): static
    {
        $this->id_entreprise = $id_entreprise;

        return $this;
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

    public function getEntrepriseIdEntreprise(): ?userhasentreprise
    {
        return $this->Entreprise_id_Entreprise;
    }

    public function setEntrepriseIdEntreprise(?userhasentreprise $Entreprise_id_Entreprise): static
    {
        $this->Entreprise_id_Entreprise = $Entreprise_id_Entreprise;

        return $this;
    }

    /**
     * @return Collection<int, ClientHasEntreprise>
     */
    public function getEntrepriseIdClient(): Collection
    {
        return $this->entreprise_id_client;
    }

    public function addEntrepriseIdClient(ClientHasEntreprise $entrepriseIdClient): static
    {
        if (!$this->entreprise_id_client->contains($entrepriseIdClient)) {
            $this->entreprise_id_client->add($entrepriseIdClient);
            $entrepriseIdClient->setEntreprise($this);
        }

        return $this;
    }

    public function removeEntrepriseIdClient(ClientHasEntreprise $entrepriseIdClient): static
    {
        if ($this->entreprise_id_client->removeElement($entrepriseIdClient)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseIdClient->getEntreprise() === $this) {
                $entrepriseIdClient->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Employes>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employes $employe): static
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->setEmployesIdEntreprise($this);
        }

        return $this;
    }

    public function removeEmploye(Employes $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getEmployesIdEntreprise() === $this) {
                $employe->setEmployesIdEntreprise(null);
            }
        }

        return $this;
    }
}
