<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService
{

    private $userRepository;
    public function __construct(UserRepository $userRepository, $serviceContainer=null)
    {
        $this->userRepository = $userRepository;
        $this->setContainer($serviceContainer);
    }

    public function isValid($email){
        return $this->userRepository->findOneBy(['email'=>$email]);
    }
}