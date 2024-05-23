<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stream $streamEval = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreamEval(): ?Stream
    {
        return $this->streamEval;
    }

    public function setStreamEval(?Stream $streamEval): static
    {
        $this->streamEval = $streamEval;

        return $this;
    }
}
