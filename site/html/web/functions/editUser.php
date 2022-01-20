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
#	Page: send.php (Page permettant l'appel à la fonction de modification de l'utilisateur par l'admin)
#
################################################################
include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
$res = false;

$id = $_POST['id'];
$password = $_POST['password'];
$valid = $_POST['valid'];
$type = $_POST['type'];
//Vérification de CSRF et de la politique de mot de passe
if ($_POST['token'] == $_SESSION['token'] && strlen($password) >= 15) {
    $res = $bdd->editUser($id, $password, $valid, $type);
}
?>

<form name="redirect" method="post" action="<?php echo '/index.php?page=userEdit"' ?>"
      enctype="multipart/form-data">
    <input type="hidden" name="editResult" value="<?php echo $res ?>">
    <input type="hidden" name="editUserTab" value="<?php echo $id ?>">
    <script language="JavaScript">document.redirect.submit();</script>
</form>