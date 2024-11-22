<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{

    public function __construct(private readonly UserService $userService,){}

    
    #[Route('/user', name: 'app_userController')]
    public function index(): Response
    {
        return $this->render('index.html.twig'
        );
    }

    #[Route(path:'/getallusers', name:'app_gettAllUsers')]

    public function getAllUsers(): Response
    {
        $users = $this->userService->getAllUsers();
        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    

    
}