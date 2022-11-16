<?php
namespace App\Service;
use PDO;

class PdoHackathon
{
    private $monPdo;

    public function __construct($server, $bdd, $user, $mdp)
    {
        PdoHackathon::$monPdo = new PDO($server . ';' . $bdd, $user, $mdp);

        PdoHackathon::$monPdo->query("SET CHARACTER SET utf8");
    }
}