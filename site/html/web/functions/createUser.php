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
#	Page: send.php (Page permettant l'appel à la fonction de création de l'utilisateur par l'admin)
#
################################################################
include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

$username = $_POST['username'];
$password = $_POST['password'];
$passwordAgain = $_POST['passwordAgain'];
$validity = $_POST['validity'];
$role = $_POST['role'];

$res = $bdd->createUser($username, $password, $passwordAgain, $validity, $role);
?>
<form name="redirect" method="post" action="<?php echo 'http://localhost:8080/index.php?page=newUser"' ?>"
      enctype="multipart/form-data">
    <input type="hidden" name="result" value="<?php echo $res ?>">
    <script language="JavaScript">document.redirect.submit();</script>
</form>
