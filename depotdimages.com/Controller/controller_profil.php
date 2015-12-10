<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Variables pour gerer les erreur (si il y a un erreur je fais + 1)
$i = 0;

//Variables de profil
$username = "";
$newPassword = "";
$newPasswordConfirm = "";
$firstName = "";
$lastName = "";

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
if(isset($_POST["Username"]) && isset($_POST['NewPassword']) && isset($_POST['NewPasswordConfirm']) && isset($_POST['FirstName']) && isset($_POST['LastName']))
{
    $username = $_POST["Username"];
    $newPassword = $_POST['NewPassword'];
    $newPasswordConfirm = $_POST['NewPasswordConfirm'];
    $firstName =  $_POST['FirstName'];
    $lastName =  $_POST['LastName'];
    header('Location: ../Views/index.php');
}

if(isset($_POST["stayConnected"]))
{
    setcookie("Connected24Heures", $_SESSION['connected'], time() + 86400 , "/");
    header('Location: ../Views/index.php');
}

// On vérifie si des champs sont vides
if (empty($_POST["Username"]))
{
    $message = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
    echo "<script type='text/javascript'>alert('$message');</script>";
    $i++;
}

if($newPassword != $newPasswordConfirm)
{
    $message = '- Le mot de passe et sa confirmation sont différents. \n';
    echo "<script type='text/javascript'>alert('$message');</script>";
    $i++;
}

// S'il n'y a aucune erreur
if ($i == 0)
{
    updateProfil($username, $newPassword, $firstName, $lastName);
    header('Location: ../Views/index.php');
}
