<!--pour info le tableau est nikel!! juste que le tableau (appel de la fonction getLesVols()) s'affiche sous le foot alors que le titre
"voici la liste des vols d'AIR AZUR"s'affiche lui bie navant le foot! -->

<!-- contenu de la page v_vol---------------------------------------------------------------------- -->

</div>

voici la liste des vols d'AIR AZUR
<?php
require_once('modele/fonctions.php');

getLesVols();

?>
</div>

<!-- contenu de la page fonctions ----------------------------------------------------------------------->

<?php

function getLesVols()
{

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=air_azur', 'ginius', 'WPO22.ADERIEUV93');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table Employe
$reponse = $bdd->query('SELECT vol.vlg_num, date_dep, date_arr, heure_dep, heure_arr, nbr_places, prix, (select arp_nom from aeroport where code = 1 ) as arp_nom_dep, arp_nom as arp_nom_arr FROM `vol` join vol_g on vol.vlg_num = vol_g.vlg_num join aeroport on vol_g.code_arp_arr = aeroport.code ');
?>


<p /><table border=2 width="75%">
   <tr><th>numéro vol</th><th>Départ</th><th>Arrivée</th><th>Places</th><th>Prix</th><th></th></tr>
<?php
// On affiche chaque entrée une à une
while ($ligne = $reponse->fetch())
{?>
<tr><td><?php echo "- ";echo $ligne["vlg_num"];?></td>
    <td><?php echo "- ";echo $ligne["arp_nom_dep"];echo " / ";echo $ligne["date_dep"];echo " / ";echo $ligne["heure_dep"];?></td>
    <td><?php echo "- ";echo $ligne["arp_nom_arr"];echo " / ";echo $ligne["date_arr"];echo " / ";echo $ligne["heure_arr"]?></td>
    <td><?php echo " ";echo $ligne["nbr_places"];?></td>
    <td><?php echo " ";echo $ligne["prix"];?></td>
    <td><input type="submit" value="Réserver"></td>
</tr>
<?php
}

/*
$tabVols = [];
while ($ligne = $reponse->fetch())
{
$unVol =[ $ligne["vlg_num"],
          $ligne["date_dep"],
          $ligne["heure_dep"],
          $ligne["date_arr"],
          $ligne["heure_arr"],
          $ligne["nbr_places"],
          $ligne["prix"]
        ];

$tabVols[] = $unVol;

}
*/
$reponse->closeCursor(); // Termine le traitement de la requête
}
/*
echo "<br><pre>";
print_r($tabVols);
echo "</pre>";

$tabVolstest = array(
  array("test1","encoretest1"),
  array("test2","encoretest2"),
  array("test3","encoretest3")
);

echo "<br><pre>";
print_r($tabVolstest);
echo "</pre>";
*/
?>
