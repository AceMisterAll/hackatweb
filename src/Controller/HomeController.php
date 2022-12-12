<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            //'controller_name' => 'HomeController',
            'messageAccueil' => 'Bienvenue',
        ]);
    }

    #[Route('/hackathons', name: 'app_hackathons')]
    public function ListeHackathon(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Hackathon::class);
        $lehackathon = $repository->findall();
        dump($lehackathon);
        return $this->render('home/leshackathons.html.twig', [
            'lehackathons' => $lehackathon,
        ]);
    }

    #[Route('/detailhackathon/{id}', name: 'app_detailhackathon')]
    public function DetailsHackathons(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Hackathon::class);
        $lehackathon=$repository->find($id);
        return $this->render('home/detailHackathon.html.twig', [
            'lehackathon' => $lehackathon,
        ]);
    }
}



