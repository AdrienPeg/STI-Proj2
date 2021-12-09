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
#	Page: userEdit.php (Permet l'édition d'un utilisateur)
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
$user = $bdd->getUserInfo($_POST['editUserTab']);
$redirect = $bdd->verifyAdmin(); //Vérifie que la session soit celle d'un admin

?>
<div id="ajout-articles">
    <div style="border-bottom: 1px solid #C4C3C3;" class="container" id="formulaire">
        <h1 style="text-decoration: underline;">Modifier utilisateur :
            <h1>
                <h4>
                    <!-- Création du formulaire -->
                    <div class="row">
                        <div class="col">
                            <form action="web/functions/editUser.php" method="post" enctype="multipart/form-data">
                                <?php if (isset($_POST['editResult'])) { //Vérification du résultat de la modification
                                    if ($_POST['editResult'] == true) {
                                        echo '<p> User edited </p>';
                                    } else {
                                        echo '<p> User edit failed </p>' . $_POST['edit_result'];
                                    }
                                } ?>
                                <p>
                                    <label for="user">Nom d'utilisateur</label>
                                    <input type="text" name="username" id="username" class="form-control" required
                                           disabled="disabled" value="<?php echo $user['username']; ?>">
                                </p>
                                <p>
                                    <label for="password">Mot de passe :</label>
                                    <input type="text" name="password" id="password" class="form-control" required
                                           value="<?php echo $user['password']; ?>">
                                </p>
                                <p>
                                    <label for="valid">Validité :</label>
                                    <select id="valid" name="valid" class="form-control" required>
                                        <!-- Sélectionne la valeur actuelle du champ de validité comme valeur par défaut -->
                                        <option value='0' <?php if ($user['valid'] == 0) echo 'selected="selected"'; ?>>
                                            Invalide
                                        </option>
                                        ";
                                        <option value='1' <?php if ($user['valid'] == 1) echo 'selected="selected"'; ?>>
                                            Valide
                                        </option>
                                        ";
                                    </select>
                                </p>
                                <p>
                                    <label for="type">Rôle :</label>
                                    <select id="type" name="type" class="form-control" required>
                                        <option value='user'<?php if ($user['type'] == 'user') echo 'selected="selected"' ?>>
                                            Utilisateur
                                        </option>
                                        ";
                                        <option value='admin'<?php if ($user['type'] == 'admin') echo 'selected="selected"' ?>>
                                            Administrateur
                                        </option>
                                        ";
                                    </select>
                                </p>
                                <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
                                <input type="hidden" name="id" id="id" class="form-control" required
                                       value="<?php echo $user['id']; ?>">
                                <input class='btn btn-secondary btn-md' type="submit" value="Modifier"
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