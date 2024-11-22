<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\UserFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserTypeController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManagerInterface,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    #[Route('/user/new', name: 'app_user_new')]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
            
            $this->entityManagerInterface->persist($user);
            $this->entityManagerInterface->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form,
        ]);
    }
}