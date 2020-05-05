<?php   

if(isset($_GET["tambour"]))
{
    echo 'Veuillez ecrire un POST';
    return false;
}

try
{
    $bdd = new PDO("mysql:host=localhost;dbname=base_tambour;charset=utf8","root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*$modif =$bdd->prepare("UPDATE instrument SET touche='c' WHERE nom='Cymbale'");
    $modif->execute();*/
}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>

<?php
$reponse =$bdd->query("SELECT * FROM instrument");

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
            if(e.key == '".$result[0]['touche']."')
            {
                lancer_son('crash.mp3');
            }
            if(e.key == '".$result[1]['touche']."')
            {
                lancer_son('snare.mp3');
            }
            if(e.key == '".$result[2]['touche']."')
            {
                lancer_son('tom-1.mp3');
            }
            if(e.key == '".$result[3]['touche']."')
            {
                lancer_son('tom-2.mp3');
            }
            if(e.key == '".$result[4]['touche']."')
            {
                lancer_son('tom-3.mp3');
            }
            if(e.key == '".$result[5]['touche']."')
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
    $index = strval($i);
    echo "<script>
            index = ".$i.";
            index = index.toString();
         </script>
        ";

    echo '<img src="./images/'.$result[$i]['icon'].'.png" alt="'.$result[$i]["icon"].'"/>'; 
    echo "<br>";
    echo "<p id='nom_instrument'>".$result[$i]["nom"]."</p>";
    echo "<br>";
    echo '<p>Modification de la touche associee a l\'instrument (1 caractere max):</p>';
    echo "<br>";
    echo "<br>";
    echo '<form name="form_modif" action="tambour.php" method="POST">
            <input type="text" id="modif_touche" name="modif_touche" maxlength="1"></input>
            <input type="hidden" name="id_instrument" value="'.$result[$i]['id'].'"></input>
            <input type="submit" name="submit" value="Modifier"></input>
          </form>
         ';
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

if(isset($_POST['submit'])) // Si on clique sur S'inscrire
    {
        // On définis les variables nécéssaires
        //htmlspecialchars() permet de protéger les champs afin d'éviter des failles XSS
        $modif_touche = htmlspecialchars($_POST['modif_touche']);
        $id = $_POST['id_instrument'];
        echo $modif_touche;
        if($modif_touche) // On vérifie si elles existent
        {
            // On insère dans la BDD qui sera `inscription` et la table `user`
            $bdd = new PDO("mysql:host=localhost;dbname=base_tambour;charset=utf8","root", "");
            $modif =$bdd->prepare("UPDATE instrument SET touche='$modif_touche' WHERE id='$id'");
            $modif->execute();
        }
        else // Tous les renseignement ne sont pas remplis
        {
            echo "Veuillez renseigner tous les champs !";
        }
    }
$reponse->closeCursor();
?>

