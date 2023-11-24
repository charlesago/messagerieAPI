<?php

namespace App\Services;

use App\Entity\Image;
use App\Entity\PrivateConversation;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImagesProcessor
{
    private ImageRepository $imageRepository;
    private UploaderHelper $uploaderHelper;
    private CacheManager $cacheManager;

    public function __construct(ImageRepository $imageRepository, UploaderHelper $uploaderHelper, CacheManager $cacheManager){
        $this->imageRepository = $imageRepository;
        $this->uploaderHelper = $uploaderHelper;
        $this->cacheManager = $cacheManager;
    }


    public function getImagesFromImageIds(array $imageIds) :array{
        $images = [];
        foreach ($imageIds as $imageId){
            $image = $this->imageRepository->find($imageId);
            if ($image){
                $images[] = $image;
            }
        }
        return $images;
    }

    public function setImagesUrlsOfMessagesFromPrivateMessage(PrivateConversation $conversation){
        $messages = $conversation->getPrivateMessages();
        foreach ($messages as $message){
            $images = $message->getImages();
            $imagesUrls = new ArrayCollection();
            foreach ($images as $image){
                $imageUrl = [];
                //$imageUrl["id"] = $image->getId();
                $imageUrl["url"] = ["id"=>$image->getId(), "url"=>$this->cacheManager->getBrowserPath($this->uploaderHelper->asset($image),"thumbnail")];
                $imagesUrls-> add($imageUrl);
            }
            $message->setImagesUrls($imagesUrls);
        }
        return $messages;
    }

    public function getThumbnailUrlFromImage(Image $image){


        return ["id"=>$image->getId(), "url"=>$this->cacheManager->getBrowserPath($this->uploaderHelper->asset($image),"thumbnail")];
    }


}