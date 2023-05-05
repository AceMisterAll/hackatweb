<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Entity\Evenement;
use App\Entity\Initiation;
use App\Entity\Hackathon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\Event;

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

    #[Route('/hackathons_search', name: 'app_hackathons_search', methods : ['POST'])]
    public function ListeHackathonSearch(ManagerRegistry $doctrine, Request $request ): Response
    {
        $search = $request->request->get('search');
        $repository = $doctrine->getRepository(Hackathon::class);
        $lehackathon = $repository->findThemeLike($search); 
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

    #[Route('event/{id}', name: 'app_event')]
    public function event(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Evenement::class);
        $Event = $repository->find($id);
        $repository2=$doctrine->getRepository(Hackathon::class);
        $lehackathon=$repository2->find($id);
        $repository3=$doctrine->getRepository(Conference::class);
        $Conference=$repository3->find($id);
        $repository4=$doctrine->getRepository(Initiation::class);
        $Initiation=$repository4->find($id);
         dump(
            $Event,
            $lehackathon,
            $Conference,
            $Initiation
        );
        
        return $this->render('home/event.html.twig', [
            'event' => $Event,
            'lehackathon' => $lehackathon,
            'conference' => $Conference,
            'initiation' => $Initiation,
        ]);

        
    }
}



