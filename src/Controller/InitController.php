<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Visiteur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    #[Route('/init', name: 'app_init')]
    public function index(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $newUser = new Visiteur(); //j'instancie un objet de la classe User
        $newUser->setUsername('admin'); //je lui affecte la valeur 'elisabeth2' à son attribut Login

        $plaintextpassword = 'admin'; //on stocke le mot de passe en clair dans une variable
        $hashedpassword = $passwordHasher->hashPassword($newUser, $plaintextpassword); //on hache le mot de passe
        //grace à la méthode hashPassword()
        $newUser->setPassword($hashedpassword); //j'affecte le mot de passe haché à l'attribut Password de mon objet

        //Faire persister l'objet créé = l'enregistrer en base de données gràce à l'ORM Doctrine
        $doctrine->getManager()->persist($newUser); //je fais persister l'objet $newUser en base de données
        $doctrine->getManager()->flush(); //flush est à appeler après avoir fait un persist

        return $this->render('init/index.html.twig', [
            'userlogin' => $newUser->getUsername(),
        ]);
    }
}
