<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService {
    public function __construct (
        private UserRepository $userRepository
    ){}
    public function getAllUsers(): array {
        return $this->userRepository->findAll();
    }

}