<?php

namespace App\Entity;

use App\Repository\InscritRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscritRepository::class)]
class Inscrit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_inscription = null;

    #[ORM\Column(length: 30)]
    private ?string $nom_insc = null;

    #[ORM\Column(length: 30)]
    private ?string $prenom_insc = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\ManyToMany(targetEntity: Initiation::class, inversedBy: 'inscrits')]
    private Collection $initiation;

    public function __construct()
    {
        $this->initiation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdInscription(): ?int
    {
        return $this->id_inscription;
    }

    public function setIdInscription(int $id_inscription): self
    {
        $this->id_inscription = $id_inscription;

        return $this;
    }

    public function getNomInsc(): ?string
    {
        return $this->nom_insc;
    }

    public function setNomInsc(string $nom_insc): self
    {
        $this->nom_insc = $nom_insc;

        return $this;
    }

    public function getPrenomInsc(): ?string
    {
        return $this->prenom_insc;
    }

    public function setPrenomInsc(string $prenom_insc): self
    {
        $this->prenom_insc = $prenom_insc;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Initiation>
     */
    public function getInitiation(): Collection
    {
        return $this->initiation;
    }

    public function addInitiation(Initiation $initiation): self
    {
        if (!$this->initiation->contains($initiation)) {
            $this->initiation->add($initiation);
        }

        return $this;
    }

    public function removeInitiation(Initiation $initiation): self
    {
        $this->initiation->removeElement($initiation);

        return $this;
    }
}
