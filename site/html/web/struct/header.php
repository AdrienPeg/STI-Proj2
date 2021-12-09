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
#   Page: header.php (Est inclu par index.php et affiche le header du site)
#
#################################################################
?>

<!DOCTYPE html>
<html>

<body>
<?php header('Content-type: text/html; charset=utf-8');?>
<!-- affichage structure du header -->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="container">
                <div class="col-md-offset-12"
                     style="padding-left: 80px; border-left-width: 80px; margin-left: 800px; width: 500px;">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="logo">
    <a href="index.php"><h1>Messagerie</h1></a>
</div>
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="top-nav">
                    <ul class="memenu skyblue">
                        <li>
                            <a href="index.php"><h4>Home</h4></a>
                        </li>
                        <li>
                            <?php if ($_SESSION['loggedin'] == true) { ?>
                                <form action="web/functions/login.php" method="post">
                                    <input type="hidden" name="disconnect" value="1"/>
                                    <input class='btn btn-secondary btn-sm' type="submit" value="Disconnect"/>
                                </form>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>


<head>

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