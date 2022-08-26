<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]
class Recruiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recruiters')]
    private ?Company $id_company = null;

    #[ORM\ManyToOne(inversedBy: 'recruiters')]
    private ?User $user_id_recruiter = null;

    #[ORM\OneToMany(mappedBy: 'recruiter_id', targetEntity: JobOffer::class)]
    private Collection $jobOffers;

    public function __construct()
    {
        $this->jobOffers = new ArrayCollection();
    }

    public function __toString()
    {
      return $this->user_id_recruiter->getEmail();
    }

    /**
     * @return User|null
     */
    public function getUserIdRecruiter(): ?User
    {
      return $this->user_id_recruiter;
    }

    /**
     * @param User|null $user_id_recruiter
     */
    public function setUserIdRecruiter(?User $user_id_recruiter): void
    {
      $this->user_id_recruiter = $user_id_recruiter;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCompany(): ?Company
    {
        return $this->id_company;
    }

    public function setIdCompany(?Company $id_company): self
    {
        $this->id_company = $id_company;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id_recruiter;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id_recruiter = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, JobOffer>
     */
    public function getJobOffers(): Collection
    {
        return $this->jobOffers;
    }

    public function addJobOffer(JobOffer $jobOffer): self
    {
        if (!$this->jobOffers->contains($jobOffer)) {
            $this->jobOffers->add($jobOffer);
            $jobOffer->setRecruiterId($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): self
    {
        if ($this->jobOffers->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getRecruiterId() === $this) {
                $jobOffer->setRecruiterId(null);
            }
        }

        return $this;
    }
}
