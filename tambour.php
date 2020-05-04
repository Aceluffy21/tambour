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

        document.addEventListener('keydown', logKey);

        function logKey(e) 
        {
            if(e.key == 'c')
            {
                lancer_son('crash.mp3');
            }
            if(e.key == 's')
            {
                lancer_son('snare.mp3');
            }
            if(e.key == 't')
            {
                lancer_son('tom-1.mp3');
            }
            if(e.key == 'y')
            {
                lancer_son('tom-2.mp3');
            }
            if(e.key == 'u')
            {
                lancer_son('tom-3.mp3');
            }
            if(e.key == 'i')
            {
                lancer_son('tom-4.mp3');
            }

        console.log(e.key);
        }

        function lancer_son(son)
        {
          var audio = document.createElement('AUDIO');
          audio.setAttribute('id','audio');
          audio.setAttribute('src','./sounds/' + son);
          audio.play();
        }
      
    
      </script>";
for($i=0;$i<$j;$i++)
{
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'"/>'; 
    echo "<p>".$result[$i]["nom"]."</p>";
    echo '<p>Focus the IFrame first (e.g. by clicking in it), then try pressing some keys.</p>
    <p id="log"></p>';


    /*affiche les instrument et déclenche le son de l'instrument au clic du boutton ( étape 5)
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'"/>'; 
    echo "<br>";
    echo '<input id="button_audio" type="button" value="'.$result[$i]['nom'].'" onclick="lancer_son(\''.$result[$i]['audio'].'\');">';
    echo "<br>";*/

   /* affiche les instruments et déclenche le son de l'instrument au clic sur l'image (étape 4)
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'" onclick="lancer_son(\''.$result[$i]['audio'].'\');" />';
    echo "<p>".$result[$i]["nom"]."</p>";*/

}
$reponse->closeCursor();
?>

