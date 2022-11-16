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

    #[Route('/Hackathons', name: 'app_Hackathons')]
    public function ListeHackathon(): Response
    {
        return $this->render('home/index.html.twig', [
            //'controller_name' => 'HomeController',
            'messageAccueil' => 'Bienvenue',
        ]);
    }
}



/*public function getLesSeries() 
{

    $req = "select * from  Hackathon";
    $res = [...]::$monPdo->prepare($req);
    $res->execute();
    $LesLignes = $res->fetchAll();
    return $LesLignes;
    
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
    






{% extends 'base.html.twig' %}

{% block body %}
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1> Liste des {{lesHackathons|lengh()}} Hackathons !<h1>
{% for LeHackathon in lesHackathons %}
<div class="card" style="width: 18rem;">
        <img>{{ LeHackathon.image }}</img>
        <h3>{{ LeHackathon.titre }}</h3>
        <p>{{ LeHackathon.resumee }}</p>
        <p>{{ LaSLeHackathonerie.duree }}</p>
        </div>
    {% endfor %}
{% endblock %}
*/











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



