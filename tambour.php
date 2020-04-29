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

       function lancer_son()
       {
          var son = document.querySelector('#change_son').value;
          console.log(son);
          var audio = document.createElement('AUDIO');
          audio.setAttribute('id','audio');
          audio.setAttribute('src','./sounds/' + son);
          audio.play();
       }
    
      </script>";
        /*Permet de lancer le son au click du bouton ou image (étape 4 et étape 5)
        function lancer_son(son)
        {
          var audio = document.createElement('AUDIO');
          audio.setAttribute('id','audio');
          audio.setAttribute('src','./sounds/' + son);
          audio.play();
       }*/
for($i=0;$i<$j;$i++)
{
    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'"/>'; 
    echo "<br>";
    echo '<form>
             <select id="change_son" name="change_son" onchange="lancer_son();">
                <option value="'.$result[0]["audio"].'">'.$result[0]["nom"].'</option>
                <option value="'.$result[1]["audio"].'">'.$result[1]["nom"].'</option>
                <option value="'.$result[2]["audio"].'">'.$result[2]["nom"].'</option>
                <option value="'.$result[3]["audio"].'">'.$result[3]["nom"].'</option>
                <option value="'.$result[4]["audio"].'">'.$result[4]["nom"].'</option>
                <option value="'.$result[5]["audio"].'">'.$result[5]["nom"].'</option>
             </select>
          </form>';
    echo '<input id="button_audio" type="button" value="'.$result[$i]['nom'].'" onclick="lancer_son(\''.$result[$i]['audio'].'\');">';
    echo "<br>";
    

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

