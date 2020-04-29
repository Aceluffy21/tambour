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
$reponse =$bdd->query("SELECT nom, icon, audio FROM instrument");

$tableau = array();

while($donnees = $reponse->fetch())
{
    $tableau[]= $donnees;
}

$base = json_encode($tableau);

$result = json_decode($base,true);

echo "<br/>";
$j = count($result);

 echo "<script>
           
       function lancer_son(son)
       {
          console.log(son);
          var audio = document.createElement('AUDIO');
          audio.setAttribute('id','audio');
          audio.setAttribute('src','./sounds/' + son);
          
          audio.play();
       }
      </script>";

for($i=0;$i<$j;$i++)
{
    /*affiche les instrument et déclenche le son de l'instrument au clic du boutton*/
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'"/>'; 
    echo "<br>";
    echo '<input id="button_audio" type="button" value="'.$result[$i]['nom'].'" onclick="lancer_son(\''.$result[$i]['audio'].'\');">';
    echo "<br>";

   /* affiche les instruments et déclenche le son de l'instrument au clic sur l'image
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'" onclick="lancer_son(\''.$result[$i]['audio'].'\');" />';
    echo "<p>".$result[$i]["nom"]."</p>";*/

}
$reponse->closeCursor();
?>

