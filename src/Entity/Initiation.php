<?php

namespace App\Entity;

use App\Repository\InitiationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InitiationRepository::class)]
class Initiation extends Evenement
{
    #[ORM\Column]
    private ?int $nb_participant = null;

    #[ORM\ManyToMany(targetEntity: Inscrit::class, mappedBy: 'initiation')]
    private Collection $inscrits;

    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
    }

    public function getNbParticipant(): ?int
    {
        return $this->nb_participant;
    }

    public function setNbParticipant(int $nb_participant): self
    {
        $this->nb_participant = $nb_participant;

        return $this;
    }

    /**
     * @return Collection<int, Inscrit>
     */
    public function getInscrits(): Collection
    {
        return $this->inscrits;
    }

    public function addInscrit(Inscrit $inscrit): self
    {
        if (!$this->inscrits->contains($inscrit)) {
            $this->inscrits->add($inscrit);
            $inscrit->addInitiation($this);
        }

        return $this;
    }

    public function removeInscrit(Inscrit $inscrit): self
    {
        if ($this->inscrits->removeElement($inscrit)) {
            $inscrit->removeInitiation($this);
        }

        return $this;
    }
}
