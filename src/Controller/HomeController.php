<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {   
        
        //methode de inscription dun user 
        // public function index(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
        // {
        // $user = new User(); 
        // $user->setEmail('daouda88@gmail.com'); 
        // $user->setPassword($userPasswordHasherInterface->hashPassWord($user, 'daouda121'));
        // $user->setFirstName('Daouda'); 
        // $user->setLastName('CAMARA'); 
        // $entityManagerInterface->persist($user);
        // $entityManagerInterface->flush();  


        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Daouda ❤️❤️❤️',
        ]);
    }
}
