<?php

namespace App\Controller;

use App\Entity\Initiation;
use App\Entity\Hackathon;
use App\Entity\Inscrit;
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
                'dateDebut' => $hackathon->getDateDebut()->format('Y-m-d'),
                'heureDebut' => $hackathon->getHeureDebut()->format('H:i:s'),
                'dateFin' => $hackathon->getDateFin()->format('Y-m-d'),
                'heureFin' => $hackathon->getHeureFin()->format('H:i:s'),
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

    #[Route('/api/hackathon/{idHackathon}/evenements', name: 'app_evenement', methods: ['GET'])]
    public function tabEvent(ManagerRegistry $doctrine, $idHackathon): JsonResponse
    {
        $Initiations = $doctrine->getRepository(Initiation::class);
        $LesInitiations = $Initiations->findby(array('hackathon' => $idHackathon));
        $Hackathons = $doctrine->getRepository(Hackathon::class);
        $leHackathon = $Hackathons->find($idHackathon);

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
                    'date' => $uneInitiation->getDate()->format('Y-m-d'),
                    'heure' => $uneInitiation->getHeure()->format('H:i:s'),
                    'duree' => $uneInitiation->getDuree()->format('H:i:s'),
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