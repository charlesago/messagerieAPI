<?php

namespace App\Controller;

use App\Entity\FriendRequest;
use App\Entity\Profile;
use App\Entity\Relation;
use App\Entity\User;
use App\Repository\FriendRequestRepository;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/friend')]
class FriendRequestController extends AbstractController
{
    #[Route('/requests', name: 'app_friend_request')]
    public function index(FriendRequestRepository $friendRequestRepository): Response
    {

        return $this->json($friendRequestRepository->findAll(), 200, [], ['groups' => 'show_requests']);

    }

    #[Route('/sendfriendrequest/{id}', name: 'send_friend_request')]
    public function send($id, ProfileRepository $repository, Request $request, SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $sender = $this->getUser()->getProfile();
        $recipient = $repository->find($id);
        $frequest = new FriendRequest();
        $frequest->setSenderProfile($sender);
        $frequest->setRecipientProfile($recipient);
        $manager->persist($frequest);
        $manager->flush();
        return $this->json($frequest, 200, [], ['groups' => 'request:read']);
    }

    #[Route('/acceptfriendrequest/{id}', name: 'accept_friend_request')]
    public function accept($id, FriendRequestRepository $repository, Request $request, SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $frequest = $repository->find($id);
        $u1 = $frequest->getSenderprofile();
        $u2 = $frequest->getRecipientprofile();
        $relation = new Relation();
        $relation->setRelationAsSender($u1);
        $relation->setRelationAsRecipient($u2);
        $manager->persist($frequest);
        $manager->persist($relation);
        $manager->flush();
        return $this->json('You have a new friend how wonderfull :)', 200);
    }

    #[Route('/declineFriendRequest/{id}', name:'decline_friend_request')]
    public function decline($id, FriendRequestRepository $repository, EntityManagerInterface $manager){
        $frequest = $repository->find($id);

        $manager->persist($frequest);
        $manager->flush();
        return $this->json($frequest->getSenderprofile()->getName().' will not be your friend !', 200);
    }
}

