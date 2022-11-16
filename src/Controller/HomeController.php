<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            //'controller_name' => 'HomeController',
            'messageAccueil' => 'Bienvenue',
        ]);
    }
    
    #[Route('/hackathons', name: 'app_hackathons')]
    public function leshackathons(ManagerRegistry $doctrine): Response
    {
        $Repository = $doctrine->getRepository(Hackathon::class);
        $leshackathons = $Repository->findAll();
        dump($leshackathons);
        return $this->render('home/leshackathons.html.twig', [
            'lesHackathons' => $leshackathons
        ]);
        
    }
    


    #[Route('/hackathon/{id}', name: 'app_hackathons_detail')]
    public function lehackathons(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Hackathon::class);
        $lehackathon = $repository->find($id);
        dump($lehackathon);
        return $this->render('serie/detail.html.twig' ,[
            'lehackathons' => $lehackathon
        ]);

    }
}



