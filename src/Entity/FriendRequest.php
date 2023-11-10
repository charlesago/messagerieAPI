<?php

namespace App\Entity;

use App\Repository\FriendRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendRequestRepository::class)]
class FriendRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'friendRequests')]
    private ?Profile $senderProfile = null;

    #[ORM\ManyToOne(inversedBy: 'friendRequests')]
    #[Groups(['sentBy'])]
    private ?Profile $recipientProfile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderProfile(): ?Profile
    {
        return $this->senderProfile;
    }

    public function setSenderProfile(?Profile $senderProfile): static
    {
        $this->senderProfile = $senderProfile;

        return $this;
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
}
