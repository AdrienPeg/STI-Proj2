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
#	Page: password.php (Page permettant les changements de mot de passe appelés par un utilisateur)
#
################################################################
include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
$old = $_POST['old'];
$new = $_POST['new'];
$newAgain = $_POST['newAgain'];
$res = 'false';
$res = $bdd->changePassword($old, $new, $newAgain);
?>

<form name="redirect" method="post" action="<?php echo 'http://localhost:8080/index.php?page=editPassword"' ?>"
      enctype="multipart/form-data">
    <input type="hidden" name="result" value="<?php echo $res ?>">
    <script language="JavaScript">document.redirect.submit();</script>
</form>

