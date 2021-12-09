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
#	Page: delete.php (Fonction permettant les appels à DELETE")
#
################################################################

//inclusion connexion à base de données
include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

//Condition de suppresion des données shouaitées pointant sur le formulaire admin pour le produit
if ((isset($_POST['deleteMessageTab'])) && (!empty($_POST['deleteMessageTab']))) {
    $bdd->deleteMessage($_POST['deleteMessageTab']);
    header("Location: http://localhost:8080/index.php?page=messages");
} else if (isset($_POST['deleteUserTab'])) //Suppression d'autorisation de couleur pour le modèle d'un bracelet
{
    $ret = $bdd->deleteUser($_POST['deleteUserTab']);
    header("Location: http://localhost:8080/index.php?page=users");
} else {
    header("Location: http://localhost/WatchOut/");
}
?>