<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $title = null;

    #[ORM\Column(length: 120)]
    private ?string $location = null;

    #[ORM\Column(length: 240)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_checked = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    private ?Recruiter $recruiter_id = null;

    #[ORM\OneToMany(mappedBy: 'JobOffers_id', targetEntity: CandidateJobOffer::class)]
    private Collection $jobOffers_job;

    public function __construct()
    {
        $this->jobOffers_job = new ArrayCollection();
    }

    public function __toString()
    {
      return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getRecruiterId(): ?Recruiter
    {
        return $this->recruiter_id;
    }

    public function setRecruiterId(?Recruiter $recruiter_id): self
    {
        $this->recruiter_id = $recruiter_id;

        return $this;
    }

    /**
     * @return Collection<int, CandidateJobOffer>
     */
    public function getJobOffersJob(): Collection
    {
        return $this->jobOffers_job;
    }

    public function addJobOffersJob(CandidateJobOffer $jobOffersJob): self
    {
        if (!$this->jobOffers_job->contains($jobOffersJob)) {
            $this->jobOffers_job->add($jobOffersJob);
        }

        return $this;
    }

    public function removeJobOffersJob(CandidateJobOffer $jobOffersJob): self
    {
        $this->jobOffers_job->removeElement($jobOffersJob);

        return $this;
    }
}
