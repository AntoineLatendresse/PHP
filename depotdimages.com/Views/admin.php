<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
showHeader("Gestionnaire de l'administrateur");
verifyConnected();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
    <link rel="apple-touch-icon" sizes="57x57" href="ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="wrap">
    <h1>_Your's are a PowerUser_</h1>
    <hr><br/>
    <form action="../Controller/controller_create_delete.php" method="post">
        <input class="inputText" type="text" name="Username" id="UserPro" title="Username" placeholder="Username">
        <input class="inputText" type="text" name="NewPassword" id="UserProfil" title="NewPassword" placeholder="New Password">
        <input class="inputText" type="text" name="FirstName" id="UserProfil" title="FirstName" placeholder="First Name">
        <input class="inputText" type="text" name="LastName" id="UserProfil" title="LastName" placeholder="Last Name">
        <a href=""><input name="create" type="submit" value="Creer" class="button" /></a>
        <br/>
        <br/><hr>
        <br/>
        <a href=""><input  name="delete" type="submit" value="Supprimer" class="button" /></a>
    </form>
</div>
<div class="wrap">
    <?php listPastUsers(); ?>
</div>
</body>
</html>
<?php
showFooter();
?>


