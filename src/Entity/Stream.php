<?php

namespace App\Entity;

use App\Repository\StreamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StreamRepository::class)]
class Stream
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'streams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Jeu $jeu = null;


    #[ORM\ManyToOne(inversedBy: 'streams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'streamEval', orphanRemoval: true)]
    private Collection $evaluations;


    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startdDate = null;

    /**
     * @var Collection<int, StreamOfTMWR>
     */
    #[ORM\OneToMany(targetEntity: StreamOfTMWR::class, mappedBy: 'link', orphanRemoval: true)]
    private Collection $streamOfTMWRs;


    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
        $this->streamOfTMWRs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJeu(): ?Jeu
    {
        return $this->jeu;
    }

    public function setJeu(?Jeu $jeu): static
    {
        $this->jeu = $jeu;

        return $this;
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

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): static
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setStreamEval($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): static
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getStreamEval() === $this) {
                $evaluation->setStreamEval(null);
            }
        }

        return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getStartdDate(): ?\DateTimeInterface
    {
        return $this->startdDate;
    }

    public function setStartdDate(\DateTimeInterface $startdDate): static
    {
        $this->startdDate = $startdDate;

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
            $streamOfTMWR->setLink($this);
        }

        return $this;
    }

    public function removeStreamOfTMWR(StreamOfTMWR $streamOfTMWR): static
    {
        if ($this->streamOfTMWRs->removeElement($streamOfTMWR)) {
            // set the owning side to null (unless already changed)
            if ($streamOfTMWR->getLink() === $this) {
                $streamOfTMWR->setLink(null);
            }
        }

        return $this;
    }

}
