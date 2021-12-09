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
#	Page: editPassword.php (Modification du mot de passe pour l'utiliasteur)
#
################################################################

?>

<!DOCTYPE html>
<html>
<script>
    function submitForm(action) {
        document.getElementById('formulaire').action = action;
        document.getElementById('formulaire').submit();
    }
</script>

<body>


<?php

include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
$bdd->verifyUser(); //Vérifie que la session est celle d'un utilisateur
?>
<div id="ajout-articles">
    <div style="border-bottom: 1px solid #C4C3C3;" class="container" id="formulaire">
        <h1 style="text-decoration: underline;">Ecrire un message :
            <h1>
                <h4>
                    <!-- Création du formulaire -->
                    <div class="row">
                        <div class="col">
                            <form action="web/functions/password.php" method="post" enctype="multipart/form-data">
                                <?php if (isset($_POST['result'])) { //Vérification du résultat de la modification
                                    if ($_POST['result'] == true) {
                                        echo '<p> Password changed </p>';
                                    } else {
                                        echo '<p> Password change failed </p>';
                                    }
                                } ?>
                                <p>
                                    <label for="sujet">Ancien mot de passe</label>
                                    <input type="text" name="old" id="old" class="form-control" required>
                                </p>
                                <p>
                                    <label for="sujet">Nouveau mot de passe</label>
                                    <input type="text" name="new" id="new" class="form-control" required>
                                </p>
                                <p>
                                    <label for="message">Répéter le nouveau mot de passe</label>
                                    <input type="text" name="newAgain" id="newAgain" class="form-control" required>
                                </p>
                                <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
                                <input class='btn btn-secondary btn-md' type="submit" value="Changer"
                                       style="float:right;"/>
                            </form>
                        </div>
                    </div>
                    <h4>
    </div>
</div>
</br>
</body>

<!-- Inclusion des fichiers css et javascript -->
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