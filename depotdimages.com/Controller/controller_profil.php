<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-26
 * Time: 12:45
 */
session_start();

include_once("../Controller/functions.php");

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
}

// On vérifie si des champs sont vides
if (empty($_POST["Username"])) {
    $error_fieldsempty = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
    $i++;
}

if($newPassword != $newPasswordConfirm) {
    $error_passwordconfirm = '- Le mot de passe et sa confirmation sont différents. \n';
    $i++;
}

// S'il n'y a aucune erreur
if ($i == 0)
{
    updateProfil($username, $newPassword, $firstName, $lastName);
    header('Location: ../Views/index.php');
}
?>
