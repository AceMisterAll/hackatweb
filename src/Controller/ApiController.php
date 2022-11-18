<?php

namespace App\Controller;
use App\Entity\Hackathon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/hackathon', name: 'app_hackathon', methods: ['GET'])]
    public function tabhackathon(ManagerRegistry $doctrine): JsonResponse
    {
        $hackathons = $doctrine->getRepository(Hackathon::class)->findAll();
        $TabHackathon = [];
        foreach ($hackathons as $hackathon) {
            $TabHackathon[] = [
                'id' => $hackathon->getId(),
                'dateDebut' => $hackathon->getDateDebut(),
                'dateFin' => $hackathon->getDateFin(),
                'description' => $hackathon->getDescription(),
                'nbPlaces' => $hackathon->getNbPlaces(),
                'theme' => $hackathon->getTheme(),
        
            ];
        }
        return new JsonResponse($TabHackathon);
    }
}