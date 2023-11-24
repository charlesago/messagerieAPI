<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\PrivateConversation;
use App\Entity\PrivateMessage;
use App\Services\ImagesProcessor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/api/private')]
class PrivateMessageController extends AbstractController
{
    #[Route('/message/in/{id}', methods:['POST'])]
    public function newMessage(Request $request, SerializerInterface $serializer, EntityManagerInterface $manager, PrivateConversation $privateConversation, ImagesProcessor $processor, UploaderHelper $helper): Response
    {
        $json = $request->getContent();
        $message = $serializer->deserialize($json, PrivateMessage::class, 'json');

        $message->setAuthor($this->getUser()->getProfile());
        $message->setCreatedAt(new \DateTimeImmutable());
        $message->setPrivateConversation($privateConversation);

        $associatedImages = $message->getAssociatedImages();
        if ($associatedImages){
            foreach($processor->getImagesFromImageIds($associatedImages) as $image){
                $message->addImage($image);
            }
        }


        $manager->persist($message);
        $manager->flush();

        $response = [
            "mess"=>"mess send",
            "message"=>$message->getContent(),
            "image"=>"https://127.0.0.1:8000".$helper->asset($image)

        ];

        return $this->json($response, 200);
    }

    #[Route('/{convId}/delete/{messageId}', methods:['DELETE'])]
    public function deleteMessage(
        #[MapEntity(id: 'convId')] PrivateConversation $privateConversation,
        #[MapEntity(id: 'messageId')] PrivateMessage $message,
        EntityManagerInterface $manager): JsonResponse
    {

        if(!$message){
            return $this->json("trying to remove something that isn't there genius", 401);
        }

        if($message->getAuthor() != $this->getUser()->getProfile()){
            return $this->json("not yours to delete", 401);
        }

        $manager->remove($message);
        $manager->flush();

        return $this->json("message deleted", 200);
    }

    #[Route('/{convId}/edit/{messageId}', methods:['PUT'])]
    public function editMessage(
        #[MapEntity(id: 'convId')] PrivateConversation $privateConversation,
        #[MapEntity(id: 'messageId')] PrivateMessage $message,
        EntityManagerInterface $manager,Request $request, SerializerInterface $serializer): Response
    {

        if($message->getAuthor() != $this->getUser()->getProfile()){
            return $this->json("not yours to change", 401);
        }

        $editedMessage =$serializer->deserialize($request->getContent(), PrivateMessage::class, 'json');
        $message->setContent($editedMessage->getContent());

        $manager->persist($message);
        $manager->flush();

        return $this->json("message edited", 200);
    }
    #[Route('/addimage/{idMessage}/{idImage}', name: 'add_image_to_private_message', methods: 'POST')]
    public function addImage(EntityManagerInterface $manager,
                             #[MapEntity(mapping: ['idMessage'=>'id'])]PrivateMessage $message,
                             #[MapEntity(mapping: ['idImage'=>'id'])]Image $image,
    ){
        $message->addImage($image);
        $manager->persist($message);
        $manager->flush();
        return $this->json("The image has been added to your message", 201);
    }


}