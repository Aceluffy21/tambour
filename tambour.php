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
?>

<?php
$reponse =$bdd->query("SELECT nom, icon FROM instrument");

$tableau = array();

while($donnees = $reponse->fetch())
{
    $tableau[]= $donnees;
}

$base = json_encode($tableau);

$result = json_decode($base,true);

$j = count($result);

for($i=0;$i<$j;$i++)
{
    echo "<img src='./images/".$result[$i]["icon"].".png' alt='".$result[$i]["icon"]."'/>";
    echo "<p>".$result[$i]["nom"]."</p>";
}
$reponse->closeCursor();
?>
