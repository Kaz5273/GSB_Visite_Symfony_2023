<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Visite::class)]
    private Collection $visite;

    #[ORM\ManyToMany(targetEntity: Praticien::class, inversedBy: 'users')]
    private Collection $praticien;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    public function __construct()
    {
        $this->visite = new ArrayCollection();
        $this->praticien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Visite>
     */
    public function getVisite(): Collection
    {
        return $this->visite;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visite->contains($visite)) {
            $this->visite->add($visite);
            $visite->setUser($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visite->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getUser() === $this) {
                $visite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Praticien>
     */
    public function getPraticien(): Collection
    {
        return $this->praticien;
    }

    public function addPraticien(Praticien $praticien): self
    {
        if (!$this->praticien->contains($praticien)) {
            $this->praticien->add($praticien);
        }

        return $this;
    }

    public function removePraticien(Praticien $praticien): self
    {
        $this->praticien->removeElement($praticien);

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
