<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Partie>
     */
    #[ORM\OneToMany(targetEntity: Partie::class, mappedBy: 'jeu')]
    private Collection $parties;

    /**
     * @var Collection<int, Stream>
     */
    #[ORM\OneToMany(targetEntity: Stream::class, mappedBy: 'jeu')]
    private Collection $streams;

    /**
     * @var Collection<int, StreamOfTMWR>
     */
    #[ORM\OneToMany(targetEntity: StreamOfTMWR::class, mappedBy: 'PlayAT', orphanRemoval: true)]
    private Collection $streamOfTMWRs;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->streams = new ArrayCollection();
        $this->streamOfTMWRs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): static
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->setJeu($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): static
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getJeu() === $this) {
                $party->setJeu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stream>
     */
    public function getStreams(): Collection
    {
        return $this->streams;
    }

    public function addStream(Stream $stream): static
    {
        if (!$this->streams->contains($stream)) {
            $this->streams->add($stream);
            $stream->setJeu($this);
        }

        return $this;
    }

    public function removeStream(Stream $stream): static
    {
        if ($this->streams->removeElement($stream)) {
            // set the owning side to null (unless already changed)
            if ($stream->getJeu() === $this) {
                $stream->setJeu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StreamOfTMWR>
     */
    public function getStreamOfTMWRs(): Collection
    {
        return $this->streamOfTMWRs;
    }

    public function addStreamOfTMWR(StreamOfTMWR $streamOfTMWR): static
    {
        if (!$this->streamOfTMWRs->contains($streamOfTMWR)) {
            $this->streamOfTMWRs->add($streamOfTMWR);
            $streamOfTMWR->setPlayAT($this);
        }

        return $this;
    }

    public function removeStreamOfTMWR(StreamOfTMWR $streamOfTMWR): static
    {
        if ($this->streamOfTMWRs->removeElement($streamOfTMWR)) {
            // set the owning side to null (unless already changed)
            if ($streamOfTMWR->getPlayAT() === $this) {
                $streamOfTMWR->setPlayAT(null);
            }
        }

        return $this;
    }
}
