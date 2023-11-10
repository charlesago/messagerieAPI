<?php

namespace App\Controller;

use App\Entity\FriendRequest;
use App\Entity\Profile;
use App\Entity\User;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class FriendRequestController extends AbstractController
{
    #[Route('/friend/request', name: 'app_friend_request')]
    public function index(): Response{
        return $this->json("alal", 200, ['groups'=> 'sentBy']); # revoir groups dans entités

    }

    #[Route('/friend/sendrequest/{id}', name: 'send_friend_request')]
    public function sendFriendRequest(Profile $profile, EntityManagerInterface $manager): Response
    {
        $request = new FriendRequest();

        $request->setSenderProfile($this->getUser()->getProfile());
        $request->setRecipientProfile($profile);

        $manager->persist($request);
        $manager->flush();

        return $this->json("friend request sent", 200 ); # revoir groups dans entités ['groups'=> '']
    }
}


