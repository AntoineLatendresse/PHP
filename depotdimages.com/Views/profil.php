<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:54
 */
include_once("../Controller/functions.php");
showHeaderProfil();
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

    <form action="../Controller/controller_profil.php" method="post">

        <label>Nom d'usager :</label> <br> <br>
        <input type="text" name="Username" title=""><br><br>
        <label>Nouveau mot de passe :</label> <br> <br>
        <input type="text" name="NewPassword" title=""><br><br>
        <label>Confirmation nouveau mot de passe :</label> <br> <br>
        <input type="text" name="NewPasswordConfirm" title=""><br><br>
        <label>Prenom :</label> <br> <br>
        <input type="text" name="FirstName" title=""><br><br>
        <label>Nom :</label> <br> <br>
        <input type="text" name="LastName" title=""><br><br>
        <a href="">
            <input  type="submit" value="Modifier..." class="button" />
        </a>

    </form>
</div>
</body>
</html>
<?php
showFooter();
?>

