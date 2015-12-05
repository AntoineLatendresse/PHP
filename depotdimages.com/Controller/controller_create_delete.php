<?php
include_once('functions.php');
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['create']) || isset($_POST['delete'])) {
    $i = 0;
    $username = NULL;
    $password = NULL;
    $firstName = NULL;
    $lastName = NULL;

//isset($var) verifie que la variable a ete cree et qu'elle n'est pas nulle
    if (isset($_POST['Username']) && isset($_POST['NewPassword']) && isset($_POST['FirstName']) && isset($_POST['LastName'])) {
        $username = $_POST['Username'];
        $password = $_POST['NewPassword'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
    }

// S'il n'y a aucune erreur
    if ($i == 0) {
        if(isset($_POST['create']))
        {
            createUser($username, $password, $firstName, $lastName);
        }
        elseif(isset($_POST['delete']))
        {
            deleteUser($username, $password, $firstName, $lastName);
        }
        header('Location: ../Views/index.php');
    } else {
        header('Location: ../Views/profil.php');
    }
}