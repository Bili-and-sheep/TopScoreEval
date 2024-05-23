<?php

namespace App\Entity;

use App\Repository\StreamOfTMWRRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StreamOfTMWRRepository::class)]
class StreamOfTMWR
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'streamOfTMWRs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'streamOfTMWRs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Jeu $PlayAT = null;

    #[ORM\ManyToOne(inversedBy: 'streamOfTMWRs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stream $link = null;

    #[ORM\ManyToOne(inversedBy: 'streamOfTMWRs')]
    private ?Stream $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPlayAT(): ?Jeu
    {
        return $this->PlayAT;
    }

    public function setPlayAT(?Jeu $PlayAT): static
    {
        $this->PlayAT = $PlayAT;

        return $this;
    }

    public function getLink(): ?Stream
    {
        return $this->link;
    }

    public function setLink(?Stream $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getDate(): ?Stream
    {
        return $this->date;
    }

    public function setDate(?Stream $date): static
    {
        $this->date = $date;

        return $this;
    }
}
