<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $last_name = null;

    #[ORM\ManyToOne(inversedBy: 'candidates')]
    private ?User $user_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileName = null;

    #[ORM\OneToMany(mappedBy: 'candidate', targetEntity: CandidateJobOffer::class)]
    private Collection $candidates;

    public function __construct()
    {
        $this->candidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
      return $this->name;
    }

  public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $file_name): self
    {
        $this->fileName = $file_name;

        return $this;
    }

    /**
     * @return Collection<int, CandidateJobOffer>
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(CandidateJobOffer $candidate): self
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates->add($candidate);
            $candidate->setCandidate($this);
        }

        return $this;
    }

    public function removeCandidate(CandidateJobOffer $candidate): self
    {
        if ($this->candidates->removeElement($candidate)) {
            // set the owning side to null (unless already changed)
            if ($candidate->getCandidate() === $this) {
                $candidate->setCandidate(null);
            }
        }

        return $this;
    }
}
