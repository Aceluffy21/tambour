<?php   

if(isset($_GET["tambour"]))
{
    echo 'Veuillez ecrire un POST';
    return false;
}

try
{
    $bdd = new PDO("mysql:host=localhost;dbname=base_tambour;charset=utf8","root", "");
}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$reponse =$bdd->query("SELECT nom FROM instrument");


while($donnees = $reponse->fetch())
{
    $tableau [] = $donnees;
}

$bddjson = json_encode($tableau);

echo $bddjson;

$reponse->closeCursor();
?>