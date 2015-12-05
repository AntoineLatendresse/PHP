<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
showHeader("Gestionnaire de mon Profil");
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
    <h1>_Your's Profil_</h1>
    <hr><br/>
    <form action="../Controller/controller_profil.php" method="post">
        <input class="inputText" type="text" name="Username" id="UserPro" title="Username" placeholder="Username">
        <input class="inputText" type="text" name="NewPassword" id="UserProfil" title="NewPassword" placeholder="New Password">
        <input class="inputText" type="text" name="NewPasswordConfirm" id="UserProfil" title="NewPasswordConfirm" placeholder="New Password Confirm">
        <input class="inputText" type="text" name="FirstName" id="UserProfil" title="FirstName" placeholder="First Name">
        <input class="inputText" type="text" name="LastName" id="UserProfil" title="LastName" placeholder="Last Name">
        <a href=""><input  type="submit" value="Modifier" class="button" /></a>
    </form>
</div>
<div class="wrap">
    <form action="../Controller/controller_profil.php" method="post">
        <a href=""><input  name="stayConnected" type="submit" value="Rester connecter pour 24 heures" class="button" /></a>
    </form>
</div>
</body>
</html>
<?php
showFooter();
?>

