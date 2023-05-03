<?php

namespace App\Controller;

use App\Entity\Hackathon;
use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController

{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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

    
    #[Route('/inscription/{idHackathon}', name: "inscription")]
    public function inscription(Request $request, ManagerRegistry $doctrine, $idHackathon)
{
    // Récupérer l'utilisateur connecté
    $user = $this->getUser();

    // Récupérer le hackathon à partir de l'ID
    $repository = $doctrine->getRepository(Hackathon::class);
    $hackathon = $repository->find($idHackathon);

    // Créer une nouvelle inscription
    $inscription = new Inscription();
    $inscription->setHackathon($hackathon);
    $inscription->setUser($user);
    // récupere la date d'aujourd'hui
    $inscription->setDateInsc(new \DateTime());

    // Enregistrer l'inscription
    $entityManager = $doctrine->getManager();
    $entityManager->persist($inscription);
    $entityManager->flush();

    //return new Response('Inscription réussie!');
    //ajoute un lien vers la page des hackathons
    return $this->redirectToRoute('app_hackathons');
}

#[Route('/MesHackathons', name: 'app_mes_hackathons')]
public function mesHackathons(): Response
{
    $user = $this->getUser();
    if (!$user) {
        return $this->redirectToRoute('app_login');
    }
    $inscriptions = $user->getInscriptions();
    $mesHackathons = array();

    foreach ($inscriptions as $inscription) {
        $hackathon = $inscription->getHackathon();
        array_push($mesHackathons, $hackathon);
    }

    return $this->render('home/MesHackathons.html.twig', [
        'mesHackathons' => $mesHackathons,
    ]);
}

}

    