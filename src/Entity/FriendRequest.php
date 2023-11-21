<?php

namespace App\Entity;

use App\Repository\FriendRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FriendRequestRepository::class)]
class FriendRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recipientprofile')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['request:read'])]
    private ?Profile $recipientProfile = null;

    #[ORM\ManyToOne(inversedBy: 'senderprofile')]
    #[Groups(['request:read'])]
    private ?Profile $senderprofile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipientProfile(): ?Profile
    {
        return $this->recipientProfile;
    }

    public function setRecipientProfile(?Profile $recipientProfile): static
    {
        $this->recipientProfile = $recipientProfile;

        return $this;
    }

    public function getSenderprofile(): ?Profile
    {
        return $this->senderprofile;
    }

    public function setSenderprofile(?Profile $senderprofile): static
    {
        $this->senderprofile = $senderprofile;

        return $this;
    }
}
