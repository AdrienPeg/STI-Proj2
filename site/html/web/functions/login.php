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
#	Page: send.php (Page permettant l'appel à la fonction de login)
#
################################################################
include_once("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

if (isset($_POST['disconnect']) && !empty($_POST['disconnect'])) {
    $bdd->unlogin();
    header("Location: http://localhost:8080/index.php?page=home");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];
$res = $bdd->login($username, $password);
?>
<form name="redirect" method="post" action="<?php echo 'http://localhost:8080/index.php?page=home"' ?>"
      enctype="multipart/form-data">
    <input type="hidden" name="login_result" value="<?php echo $res ?>">
    <script language="JavaScript">document.redirect.submit();</script>
</form>
