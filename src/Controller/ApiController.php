<?php

namespace App\Controller;
use App\Entity\Hackathon;
use App\Service\PdoHackathon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
                'heureDebut' => $hackathon->getHeureDebut(),
                'dateFin' => $hackathon->getDateFin(),
                'heureFin' => $hackathon->getHeureFin(),
                'salle' => $hackathon->getSalle(),
                'rue' => $hackathon->getRue(),
                'cp' => $hackathon->getCp(),
                'theme' => $hackathon->getTheme(),
                'description' => $hackathon->getDescription(),
                'image' => $hackathon->getImage(),
                'nbPlaces' => $hackathon->getNbPlaces(),
        
            ];
        }
        return new JsonResponse($TabHackathon);
    }

    #[Route('/api/newinscrit', name: 'app_api_newinscrit', methods: ['POST'])]
    public function inscrireatelier(Request $request, PdoHackathon $pdoHackathon)
    {
        $content = $request->getContent();
        if (!empty($content)) {
            $linscrit = json_decode($content, true);
            $linscritajouter = $pdoHackathon->setLinscrit($linscrit);
            $tabJson =
                [
                    'nom' => $linscritajouter['nom'],
                    'prenom' => $linscritajouter['prenom'],
                    'mail' => $linscritajouter['mail'],
                    'initiationid' => $linscritajouter['initiationid'],
                ];
        }
        return new JsonResponse($tabJson, Response::HTTP_CREATED);
    }
}