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
if ($_POST['token'] == $_SESSION['token'] && isset($_POST['id']) && isset($_POST['valid']) && isset($_POST['type'])) {
    $id = $_POST['id'];
    $valid = $_POST['valid'];
    $type = $_POST['type'];

    if (isset($_POST['passwordOne']) && !empty($_POST['passwordOne']) && isset($_POST['passwordTwo']) && !empty($_POST['passwordTwo'])){ // L'utilisateur demande aussi de changer le mot de passe
        $passwordOne = $_POST['passwordOne'];
        $passwordTwo = $_POST['passwordTwo'];

        if (strlen($passwordOne) >= 15 && $passwordOne == $passwordTwo)
            $res = $bdd->editUser($id, $passwordOne, $valid, $type);
    } else {
        $res = $bdd->editUserWithoutPass($id, $valid, $type);
    }
}



?>

<form name="redirect" method="post" action="<?php echo '/index.php?page=userEdit"' ?>"
      enctype="multipart/form-data">
    <input type="hidden" name="editResult" value="<?php echo $res ?>">
    <input type="hidden" name="editUserTab" value="<?php echo $id ?>">
    <script language="JavaScript">document.redirect.submit();</script>
</form>