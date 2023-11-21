<?php

namespace App\Entity;

use App\Repository\PrivateChatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivateChatRepository::class)]
class PrivateChat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'creator')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $creator = null;

    #[ORM\ManyToOne(inversedBy: 'member')]
    private ?Profile $member = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Datetime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreator(): ?Profile
    {
        return $this->creator;
    }

    public function setCreator(?Profile $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function getMember(): ?Profile
    {
        return $this->member;
    }

    public function setMember(?Profile $member): static
    {
        $this->member = $member;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->Datetime;
    }

    public function setDatetime(\DateTimeInterface $Datetime): static
    {
        $this->Datetime = $Datetime;

        return $this;
    }
}
