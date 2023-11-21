<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['request:read', 'relation:read'])]    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:read'])]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?User $ofUser = null;

    #[ORM\OneToMany(mappedBy: 'relationAsSender', targetEntity: Relation::class)]
    private Collection $relations;

    #[ORM\OneToMany(mappedBy: 'recipientProfile', targetEntity: FriendRequest::class)]
    private Collection $recipientprofile;

    #[ORM\OneToMany(mappedBy: 'senderprofile', targetEntity: FriendRequest::class)]
    private Collection $senderprofile;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: PrivateChat::class)]
    private Collection $creator;

    #[ORM\OneToMany(mappedBy: 'member', targetEntity: PrivateChat::class)]
    private Collection $member;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Message::class)]
    private Collection $messages;


    public function getFriendsList()
    {
        $list = [];
        foreach ($this->senderprofile as $relation){

            if($relation->getSenderProfile() != $this)
            {
                $otherProfile = $relation->getSenderProfile();

            }else{
                $otherProfile = $relation->getRecipientProfile();
            }
            $list[]=$otherProfile;
        }
        foreach ($this->recipientprofile as $relation){

            if($relation->getSenderProfile() != $this)
            {
                $otherProfile = $relation->getSenderProfile();

            }else{
                $otherProfile = $relation->getRecipientProfile();
            }
            $list[]=$otherProfile;
        }

        return $list;
    }
    public function __construct()
    {
        $this->friendRequests = new ArrayCollection();
        $this->relations = new ArrayCollection();
        $this->recipientprofile = new ArrayCollection();
        $this->senderprofile = new ArrayCollection();
        $this->creator = new ArrayCollection();
        $this->member = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOfUser(): ?User
    {
        return $this->ofUser;
    }

    public function setOfUser(?User $ofUser): static
    {
        $this->ofUser = $ofUser;

        return $this;
    }


    /**
     * @return Collection<int, Relation>
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(Relation $relation): static
    {
        if (!$this->relations->contains($relation)) {
            $this->relations->add($relation);
            $relation->setRelationAsSender($this);
        }

        return $this;
    }

    public function removeRelation(Relation $relation): static
    {
        if ($this->relations->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getRelationAsSender() === $this) {
                $relation->setRelationAsSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendRequest>
     */
    public function getRecipientprofile(): Collection
    {
        return $this->recipientprofile;
    }

    public function addRecipientprofile(FriendRequest $recipientprofile): static
    {
        if (!$this->recipientprofile->contains($recipientprofile)) {
            $this->recipientprofile->add($recipientprofile);
            $recipientprofile->setRecipientProfile($this);
        }

        return $this;
    }

    public function removeRecipientprofile(FriendRequest $recipientprofile): static
    {
        if ($this->recipientprofile->removeElement($recipientprofile)) {
            // set the owning side to null (unless already changed)
            if ($recipientprofile->getRecipientProfile() === $this) {
                $recipientprofile->setRecipientProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendRequest>
     */
    public function getSenderprofile(): Collection
    {
        return $this->senderprofile;
    }

    public function addSenderprofile(FriendRequest $senderprofile): static
    {
        if (!$this->senderprofile->contains($senderprofile)) {
            $this->senderprofile->add($senderprofile);
            $senderprofile->setSenderprofile($this);
        }

        return $this;
    }

    public function removeSenderprofile(FriendRequest $senderprofile): static
    {
        if ($this->senderprofile->removeElement($senderprofile)) {
            // set the owning side to null (unless already changed)
            if ($senderprofile->getSenderprofile() === $this) {
                $senderprofile->setSenderprofile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PrivateChat>
     */
    public function getCreator(): Collection
    {
        return $this->creator;
    }

    public function addCreator(PrivateChat $creator): static
    {
        if (!$this->creator->contains($creator)) {
            $this->creator->add($creator);
            $creator->setCreator($this);
        }

        return $this;
    }

    public function removeCreator(PrivateChat $creator): static
    {
        if ($this->creator->removeElement($creator)) {
            // set the owning side to null (unless already changed)
            if ($creator->getCreator() === $this) {
                $creator->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PrivateChat>
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(PrivateChat $member): static
    {
        if (!$this->member->contains($member)) {
            $this->member->add($member);
            $member->setMember($this);
        }

        return $this;
    }

    public function removeMember(PrivateChat $member): static
    {
        if ($this->member->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getMember() === $this) {
                $member->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setAuthor($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getAuthor() === $this) {
                $message->setAuthor(null);
            }
        }

        return $this;
    }
}
