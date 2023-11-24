<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserHasEntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserHasEntrepriseRepository::class)]
#[ApiResource]
class UserHasEntreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'user_id_entreprise')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Users_idUsers = null;

    #[ORM\OneToMany(mappedBy: 'Entreprise_id_Entreprise', targetEntity: Entreprise::class)]
    private Collection $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsersIdUsers(): ?User
    {
        return $this->Users_idUsers;
    }

    public function setUsersIdUsers(?User $Users_idUsers): static
    {
        $this->Users_idUsers = $Users_idUsers;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->setEntrepriseIdEntreprise($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getEntrepriseIdEntreprise() === $this) {
                $entreprise->setEntrepriseIdEntreprise(null);
            }
        }

        return $this;
    }
}
