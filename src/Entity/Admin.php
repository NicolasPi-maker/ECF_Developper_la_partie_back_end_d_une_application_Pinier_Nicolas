<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $username = null;

    #[ORM\ManyToOne(inversedBy: 'admins')]
    private ?User $user_id_admin = null;

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->user_id_admin;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id_admin = $user_id;

        return $this;
    }
}
