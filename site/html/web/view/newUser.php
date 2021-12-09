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
#	Page: newUser.php (Création d'un nouvel utilisateur)
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

$redirect = $bdd->verifyAdmin(); //Vérifie que la session soit celle d'un admin


?>
<div id="ajout-articles">
    <div style="border-bottom: 1px solid #C4C3C3;" class="container" id="formulaire">
        <h1 style="text-decoration: underline;">Créer un nouvel utilisateur :
            <h1>
                <h4>
                    <!-- Création du formulaire -->
                    <div class="row">
                        <div class="col">
                            <form action="web/functions/createUser.php" method="post" enctype="multipart/form-data">
                                <?php if (isset($_POST['result'])) { //Vérification du résultat de la création
                                    if ($_POST['result'] == true) {
                                        echo '<p> User created </p>';
                                    } else {
                                        echo '<p> User creation failed </p>';
                                    }
                                } ?>
                                <p>
                                    <label for="user">Nom d'utilisateur</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </p>
                                <p>
                                    <label for="password">Mot de passe</label>
                                    <input type="text" name="password" id="password" class="form-control" required>
                                </p>
                                <p>
                                    <label for="passwordAgain">Entrez à nouveau le mot de passe</label>
                                    <input type="text" name="passwordAgain" id="Again" class="form-control" required>
                                </p>
                                <p>
                                    <label for="validity">Validité :</label>
                                    <select id="validity" name="validity" class="form-control" required>
                                        <option value='0'>Invalide</option>
                                        ";
                                        <option value='1'>Valide</option>
                                        ";
                                    </select>
                                </p>
                                <p>
                                    <label for="role">Rôle :</label>
                                    <select id="role" name="role" class="form-control" required>
                                        <option value='user'>Utilisateur</option>
                                        ";
                                        <option value='admin'>Administrateur</option>
                                        ";
                                    </select>
                                </p>
                                <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
                                <input class='btn btn-secondary btn-md' type="submit" value="Créer"
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