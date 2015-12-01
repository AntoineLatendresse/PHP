<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
session_start();
showHeaderAdmin();
verifyConnected();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div class="wrap">
    <form action="../Controller/controller_create_delete.php" method="post">
        <label>Nom d'usager :</label> <br> <br>
        <input type="text" name="Username" title=""><br><br>
        <label>Mot de passe :</label> <br> <br>
        <input type="text" name="NewPassword" title=""><br><br>
        <label>Prenom :</label> <br> <br>
        <input type="text" name="FirstName" title=""><br><br>
        <label>Nom :</label> <br> <br>
        <input type="text" name="LastName" title=""><br><br>
        <a href=""><input name="create" type="submit" value="Creer..." class="button" /></a>
        <a href=""><input  name="delete" type="submit" value="Supprimer..." class="button" /></a>
    </form>
</div>
</body>
</html>
<?php
showFooter();
?>


