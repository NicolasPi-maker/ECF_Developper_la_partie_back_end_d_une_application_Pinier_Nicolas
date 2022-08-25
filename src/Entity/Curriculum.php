<?php

namespace App\Entity;

use App\Repository\CurriculumRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurriculumRepository::class)]
class Curriculum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $file_name = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Candidate $candidate_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getCandidateId(): ?Candidate
    {
        return $this->candidate_id;
    }

    public function setCandidateId(?Candidate $candidate_id): self
    {
        $this->candidate_id = $candidate_id;

        return $this;
    }
}
