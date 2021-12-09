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
#	Page: users.php (Liste les utilisateurs de la base de données)
#
################################################################

?>
<!DOCTYPE html>
<html>

<?php


include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
$redirect = $bdd->verifyAdmin(); //Vérifie que la session soit celle d'un admin
?>

<div class="container" id="DeleteEdit">
    <!--Affichage des articles -->
    <div id="affichage-articles">
        <h1 style="text-decoration: underline;"> Utilisateurs </h1>
        <h4>
            <?php
            $userid = $_SESSION['id'];
            $users = $bdd->getAllUsers();
            //Création du tableau qui contiendra nos données
            echo "<table class='table'>
						<tr>
						<th>ID user</th>
						<th>Nom de l'utilisateur</th>
						<th>Validité</th>
						<th>Type</th>
						</tr>";

            //Création d'une boucle qui ira chercher les données demandées et les affichera dans un tableau
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['valid'] . "</td>";
                echo "<td>" . $user['type'] . "</td>";
                ?>
                <!-- Création du bouton delete / edit dans le tableau qui supprimera / editera la ligne à laquelle il est -->
                <td>
                    <form action="web/functions/delete.php" method="post">
                        <input type="hidden" name="deleteUserTab" value="<?php echo $user['id']; ?>"/>
                        <input class='btn btn-danger btn-sm' type="submit" value="Delete"/>
                    </form>
                </td>
                <td>
                    <form action="<?php echo '?page=userEdit' ?>" method="post">
                        <input type="hidden" name="editUserTab" value="<?php echo $user['id']; ?>"/>
                        <input class='btn btn-secondary btn-sm' type="submit" value="Edit"/>
                    </form>
                </td>
                <?php
                echo "</tr>";
            }
            echo "</table>";
            ?>
            <button class="btn btn-secondary btn-md" onclick="history.go(-1);">Back </button>
    </div>
</div>


<!-- Inclusion du header avec lien vers les fichiers css et les scripts js -->
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