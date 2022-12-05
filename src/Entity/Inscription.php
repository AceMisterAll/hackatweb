<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_insc = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_insc = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hackathon $hackathon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdInsc(): ?int
    {
        return $this->id_insc;
    }

    public function setIdInsc(int $id_insc): self
    {
        $this->id_insc = $id_insc;

        return $this;
    }

    public function getDateInsc(): ?\DateTimeInterface
    {
        return $this->date_insc;
    }

    public function setDateInsc(\DateTimeInterface $date_insc): self
    {
        $this->date_insc = $date_insc;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHackathon(): ?Hackathon
    {
        return $this->hackathon;
    }

    public function setHackathon(?Hackathon $hackathon): self
    {
        $this->hackathon = $hackathon;

        return $this;
    }
}
