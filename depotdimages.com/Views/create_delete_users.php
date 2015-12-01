<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:54
 */
include_once("../Controller/functions.php");
showHeaderAdmin();
verifyConnected();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div class="wrap">

    <form action="../Controller/controller_create_delete.php" method="post">

        <label>Nom d'usager :</label> <br> <br>
        <input type="text" name="Username"><br><br>
        <label>Mot de passe :</label> <br> <br>
        <input type="text" name="NewPassword"><br><br>
        <label>Prenom :</label> <br> <br>
        <input type="text" name="FirstName"><br><br>
        <label>Nom :</label> <br> <br>
        <input type="text" name="LastName"><br><br>
        <a href="">
            <input name="create" type="submit" value="Creer..." class="button" />
        </a>
        <a href="">
            <input  name="delete" type="submit" value="Supprimer..." class="button" />
        </a>

    </form>
</div>
</body>
</html>
<?php
showFooter();
?>


