<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\DoctrineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, UserPasswordHasherInterface $passwordHacher, ManagerRegistry $doctrine): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $doctrine->getManager();
            //encode le mot de passe
            $user->setPassword(
                $passwordHacher->hashPassword($user, $user->getPassword()));
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_login');
        }
        return $this->render('inscription/inscription.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);;
    }
}
