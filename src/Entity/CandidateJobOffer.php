<?php

namespace App\Entity;

use App\Repository\CandidateJobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateJobOfferRepository::class)]
class CandidateJobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_checked = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers_job')]
    private ?JobOffer $jobOffers_id = null;

    #[ORM\ManyToOne(inversedBy: 'candidates')]
    private ?Candidate $candidate_id = null;

    public function __toString(): string
    {
      return $this->is_checked;
    }

  public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsChecked(): ?bool
    {
        return $this->is_checked;
    }

    public function setIsChecked(?bool $is_checked): self
    {
        $this->is_checked = $is_checked;

        return $this;
    }

    public function getJobOffersId(): ?JobOffer
    {
        return $this->jobOffers_id;
    }

    public function setJobOffersId(?JobOffer $JobOffers_id): self
    {
        $this->jobOffers_id = $JobOffers_id;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate_id;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate_id = $candidate;

        return $this;
    }
}
