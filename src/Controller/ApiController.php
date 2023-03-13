<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Hackathon;
use App\Entity\Inscrit;
use App\Service\PdoHackathon;
use Doctrine\Persistence\ManagerRegistry;
use SebastianBergmann\Environment\Console;
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
    public function inscrireatelier(Request $request, ManagerRegistry $doctrine)
    {
        $content = $request->getContent();
        dump($content);
        if (!empty($content)) {
            $postInscrit = json_decode($content, true);
            dump($postInscrit);
            $linscrit = new inscrit();
            $linscrit->setNomInsc($postInscrit['nom']);
            $linscrit->setPrenomInsc($postInscrit['prenom']);
            $linscrit->setMail($postInscrit['mail']);
            $repository = $doctrine->getRepository(Initiation::class);
            $initiation = $repository->find($postInscrit['initiation_id']);
            $linscrit->addInitiation($initiation);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($linscrit);
            $entityManager->flush();


            $tabJson =
                [
                    'nom' => $linscrit->getPrenomInsc(),
                    'prenom' => $linscrit->getNomInsc(),
                    'mail' => $linscrit->getMail(),
                    'initiationid' => $initiation->getId(),
                ];
        }
        return new JsonResponse($tabJson, Response::HTTP_CREATED);
    }
    
    #[Route('/api/hackathon/{idEvenement}/evenements', name: 'app_evenement', methods: ['GET'])]
    public function tabEvent(ManagerRegistry $doctrine, $idEvenement): JsonResponse
    {
        $Initiations = $doctrine->getRepository(Initiation::class);
        $LesInitiations = $Initiations->findby(array('id' => $idEvenement));
        dump($LesInitiations);
        $Hackathons = $doctrine->getRepository(Hackathon::class);
        $leHackathon = $Hackathons->find($idEvenement);

        if($leHackathon !== null)
        {
            $tableau = [];
            foreach($LesInitiations as $uneInitiation)
            {
                $tableau[] =
                [
                    'id' => $uneInitiation->getId(),
                    'nbParticipant' => $uneInitiation->getNbParticipant(),
                    'libelleEvenement' => $uneInitiation->getLibelle(),
                    'date' => $uneInitiation->getDate(),
                    'heure' => $uneInitiation->getHeure(),
                    'duree' => $uneInitiation->getDuree(),
                    'salle' => $uneInitiation->getSalle(),

                ];
            }
            return new JsonResponse($tableau);
        }
        else{
            return new JsonResponse(['message' => 'Hackathon not found'], Response::HTTP_NOT_FOUND);
        }
    }
}