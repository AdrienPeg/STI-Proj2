<?php
#################################################################
#
#	Projet STI
#	Auteurs:		Adrien Peguiron, Nicolas Viotti
#
#################################################################
#
# 	Date :		01.10.2021
#	Version :		1.0
#	Révisions :		-
#
#################################################################
#
#	Page: messageDetails.php (Affichage du message avec ses détails)
#
################################################################

#session_start();

?>
<!DOCTYPE html>
<html>

<?php

include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
$bdd->verifyUser(); //Vérification que la session est celle d'un utilisateur
?>
<div class="container" id="DeleteEdit">
    <!--Affichage des articles -->
    <div id="affichage-articles">
        <h1 style="text-decoration: underline;"> Message </h1>
        <h4>

            <?php
            $messageid = $_POST['messageDetailsTab'];
            $message = $bdd->getMessage($messageid);


            //Création du tableau qui contiendra nos données
            echo "<table class='table'>
						<tr>
						<th>ID Message</th>
						<th>Date de réception</th>
						<th>Expéditeur</th>
						<th>Sujet</th>
						</tr>
						";

            //Création d'une boucle qui ira chercher les données demandées et les affichera dans un tableau

            echo "<tr>";
            echo "<td>" . $message['id'] . "</td>";
            echo "<td>" . $message['date'] . "</td>";
            echo "<td>" . $message['id_expediteur'] . "</td>";
            echo "<td>" . $message['subject'] . "</td>";
            echo "</tr>";
            echo "<th> Corps </th>";
            echo "<tr>";
            echo "<td>" . $message['body'] . "</td>";
            echo "</tr>";

            echo "</table>";
            ?>
            <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
    </div>
</div>


<!-- Inclusion du header avec lien vers les fichiers css et les scripts js -->
<head>
    <!-- Inclusion du header avec lien vers les fichiers css et les scripts js -->
    <title>Messagerie</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- jquery permettant le lancement du bootsrap javascript-->
    <script src="js/jQuery.min.js"></script>
    <!--Fichier du thème-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <link href="css/memenu.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="js/memenu.js"></script>
    <script>$(document).ready(function () {
            $(".memenu").memenu();
        });</script>
    <!--Déroulement facilité de la page-->

</head>

</html>