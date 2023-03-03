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

    public function setLinscrit($linscrit)
    {
        $req = "INSERT INTO inscrit (nom_insc, prenom_insc, mail) VALUES (:nom, :prenom, :mail)";
        $res = PdoHackathon::$monPdo->prepare($req);
        $res->bindValue(':nom', $linscrit['nom'], PDO::PARAM_STR);
        $res->bindValue(':prenom', $linscrit['prenom'], PDO::PARAM_STR);
        $res->bindValue(':mail', $linscrit['mail'], PDO::PARAM_STR);
        $res->execute();

        $req1 = "SELECT id FROM inscrit WHERE id=LAST_INSERT_ID()";
        $res1 = PdoHackathon::$monPdo->prepare($req1);
        $res1->execute();
        $inscritid = $res1->fetch();

        $req2 = "INSERT INTO inscrit_initiation (inscrit_id, initiation_id) VALUES ($inscritid[0], $linscrit[initiation_id])";
        $res2 = PdoHackathon::$monPdo->prepare($req2);
        $res2->execute();
        return $inscritid;
    }
}