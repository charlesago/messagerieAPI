<?php

namespace App\Controller;

use App\Entity\Image;
use App\Services\ImagesProcessor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageController extends AbstractController
{
    #[Route('api/image/upload', methods:['POST'])]
    public function index(Request $request, EntityManagerInterface $manager, UploaderHelper $helper, ImagesProcessor $imagesProcessor): Response
    {

        $requestedImage = $request->files->get('image');
        if ($requestedImage){
            $image = new Image();
            $image->setImageFile($requestedImage);
            $image->setUploadBy($this->getUser()->getProfile());
            $manager->persist($image);

            $manager->flush();
            $postProcessedImage = $imagesProcessor->getThumbnailUrlFromImage($image);
            $response = [
                "message"=>"bravo pour ton upload",
                "imageId"=>$postProcessedImage["id"],
                "imageUrl"=>$postProcessedImage["url"]

            ];


            return $this->json($response,201,[],["groups"=>"ImageIndexing"]);
        }

        return $this->json("pas marcher",404);
    }
}
