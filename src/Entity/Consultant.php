<?php

namespace App\Entity;

use App\Repository\ConsultantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultantRepository::class)]
class Consultant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $username = null;

    #[ORM\ManyToOne(cascade: ["remove"], inversedBy: 'consultants')]
    private ?User $user_id_consultant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

  /**
   * @return User|null
   */
  public function getUserIdConsultant(): ?User
  {
    return $this->user_id_consultant;
  }

  /**
   * @param User|null $user_id_consultant
   */
  public function setUserIdConsultant(?User $user_id_consultant): void
  {
    $this->user_id_consultant = $user_id_consultant;
  }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id_consultant;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id_consultant = $user_id;

        return $this;
    }
}
