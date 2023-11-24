<?php

namespace App\Controller;

use App\Entity\PrivateConversation;
use App\Entity\Profile;
use App\Repository\PrivateConversationRepository;
use App\Services\ImagesProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/private/conversation')]
class PrivateConversationController extends AbstractController
{
    #[Route('s', methods:['GET'])]
    public function index(PrivateConversationRepository $repository): Response
    {
        $privateConversations = $repository->findAll();
        return $this->json($privateConversations, 200,[], ['groups'=>'show_privateConversations']);
    }

    #[Route('/get/{id}', name: 'get_private_messages', methods: 'GET')]
    public function get(PrivateConversation $conversation, ImagesProcessor $processor){

        return $this->json($processor->setImagesUrlsOfMessagesFromPrivateMessage($conversation), 200, [], ["groups'=>'ImageIndexing"]);
    }
    #[Route('s/{id}',  methods:['GET'])]
    public function indexAllMyConversations(Profile $profile, PrivateConversationRepository $repository): Response
    {

        $conversations = $profile->getPrivateConversationIds();


        return $this->json($conversations, 200, [],['groups'=>'show_MyPrivateConversations'] );
    }

    #[Route('/{id}',  methods:['GET'])]
    public function indexAllMessagesOfConversation(PrivateConversation $privateConversation): Response
    {
        $current = $this->getUser()->getProfile();
        if($current == $privateConversation->getParticipantA() or $current == $privateConversation->getParticipantB()){
            $messages = $privateConversation->getPrivateMessages();
            return $this->json($messages, 200, [],['groups'=>'show_privateConversationMessages'] );
        }
        return $this->json("mind your own business", 401);

    }
}