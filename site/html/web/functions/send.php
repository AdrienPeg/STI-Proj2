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
#	Page: send.php (Page permettant les envois de message)
#
################################################################

include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

$idReceiver = $_POST['destinataire'];
$subject = htmlspecialchars($_POST['sujet']);
$idSender = $_SESSION['id'];
$date = date("d/m/Y H:i");
$body = htmlspecialchars($_POST['message']);

//Vérification de CSRF
if ($_POST['token'] == $_SESSION['token']) {
    $bdd->sendMessage($idSender, $idReceiver, $subject, $date, $body);
}
header("Location: /index.php?page=home");
