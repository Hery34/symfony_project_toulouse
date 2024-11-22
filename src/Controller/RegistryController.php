<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistryController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManagerInterface){}

    #[Route('/registry', name: 'app_registry')]
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $plaintextPassword = "...";

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $user->setName('test');
        $user->setEmail('test@annexx.com');

        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();

        // ...
        return new Response('Password hashed successfully');
    }
}