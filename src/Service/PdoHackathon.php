<?php
namespace App\Service;
use PDO;

class PdoHackathon
{
    private static $monPdo;
    public function __construct($server, $bdd, $user, $mdp)
    {
        PdoHackathon::$monPdo = new PDO($server.';'.$bdd, $user, $mdp, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        //PdoHackathon::$monPdo->query("SET CHARACTER SET utf8");
    }
}