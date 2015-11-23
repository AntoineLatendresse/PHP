<?php
showHeader();
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:54
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
    <div class="wrap">

        <form action="<?php echo CONTROLLER_UPDATE_PASSWORD ?>" method="post">

            <label>Nom d'usager :</label>

            <label>Mot de passe :</label>

            <label>Prenom :</label>

            <label>Nom :</label>

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

