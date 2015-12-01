<?php
include_once('functions.php');
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
session_start();

if (isset($_POST['create'])) {
    $i = 0;
    $username = NULL;
    $password = NULL;
    $firstName = NULL;
    $lastName = NULL;

//isset($var) v�rifie que la variable a �t� cr�� et qu'elle n'est pas nulle
    if (isset($_POST['Username']) && isset($_POST['NewPassword']) && isset($_POST['FirstName']) && isset($_POST['LastName'])) {
        $username = $_POST['Username'];
        $password = $_POST['NewPassword'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
    }

// S'il n'y a aucune erreur
    if ($i == 0) {
        createUser($username, $password, $firstName, $lastName);

        header('Location: ../Views/index.php');
    } else {
        header('Location: ../Views/index.php');
    }
}

if (isset($_POST['delete'])){

    $i = 0;
    $username = NULL;
    $password = NULL;
    $firstName = NULL;
    $lastName = NULL;

//isset($var) v�rifie que la variable a �t� cr�� et qu'elle n'est pas nulle
    if (isset($_POST['Username']) && isset($_POST['NewPassword']) && isset($_POST['FirstName']) && isset($_POST['LastName'])) {
        $username = $_POST['Username'];
        $password = $_POST['NewPassword'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
    }

// S'il n'y a aucune erreur
    if ($i == 0) {
        deleteUser($username, $password, $firstName, $lastName);

        header('Location: ../Views/index.php');
    } else {
        header('Location: ../Views/admin.php');
    }
}