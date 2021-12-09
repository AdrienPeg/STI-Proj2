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
#	Page: index.php (Base de la structure dynamique du site web)
#
#################################################################

session_start();
?>

<html>

<!-- On crée la structure primaire du site web et on y ajoute les différentes pages -->

<head>
    <title>Messagerie</title>
</head>
<body>
<table border=0 width=100%>
    <tr>
        <td>
            <?php include ("web/struct/header.php");?>
        </td>
    </tr>
</table>

<table border=0 width=100%>
    <tr>
        <td>
            <?php include ("web/struct/body.php");?>
        </td>
    </tr>
</table>

<table border=0 width=100%>
    <tr>
        <td>
            <?php include ("web/struct/footer.php");?>
        </td>
    </tr>
</table>

</body>
</html>