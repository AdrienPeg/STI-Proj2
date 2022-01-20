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

//Vérification de CSRF
if ($_POST['token'] == $_SESSION['token']) {
//Condition de suppresion des données shouaitées pointant sur le formulaire admin pour le produit
    if ((isset($_POST['deleteMessageTab'])) && (!empty($_POST['deleteMessageTab'])) && ($bdd->verifyUserMessage($_POST['deleteMessageTab']) == true)) {
        $bdd->deleteMessage($_POST['deleteMessageTab']);
        header("Location: /index.php?page=messages");
    } else if (isset($_POST['deleteUserTab'])) {
        $ret = $bdd->deleteUser($_POST['deleteUserTab']);
        header("Location: /index.php?page=users");
    } else {
        header("Location: /index.php?page=messages");
    }
}
?>