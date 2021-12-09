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
#	Page: writeMessage.php (Ecriture et envoi d'un message)
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
$bdd->verifyUser();

?>
<div id="ajout-articles">
    <div style="border-bottom: 1px solid #C4C3C3;" class="container" id="formulaire">
        <h1 style="text-decoration: underline;">Ecrire un message :
            <h1>
                <h4>
                    <!-- Création du formulaire -->
                    <div class="row">
                        <div class="col">
                            <form action="web/functions/send.php" method="post" enctype="multipart/form-data">
                                <p>
                                    <label for="destinataire">Destinataire :</label>
                                    <select id="destinataire" name="destinataire" class="form-control" required>
                                        <?php
                                        //Selection de tous les utilisateurs
                                        $users = $bdd->getAllUsers();
                                        foreach ($users as $row) {
                                            if (isset($_POST['answerTab']) && $_POST['answerTab'] == $row['id']) {
                                                //Si le message est une réponse à un autre, l'utilisateur sélectionné par défaut est celui à qui répondre
                                                echo "<option value='{row['id']}'selected='selected'>{$row['username']}</option>";
                                            } else {
                                                if ($row['id'] != $_SESSION['id']) {
                                                    echo "<option value='{$row['id']}'>{$row['username']}</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="sujet">Sujet</label>
                                    <input type="text" name="sujet" id="sujet" class="form-control" required>
                                </p>
                                <p>
                                    <label for="message">Message</label>
                                    <input type="text" name="message" id="message" class="form-control" required>
                                </p>
                                <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
                                <input class='btn btn-secondary btn-md' type="submit" value="Envoyer"
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