<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/30/2015
 * Time: 11:33 AM
 */

session_start();

include_once('functions.php');

if (isset($_POST['create'])) {
echo "aaaaaaaaaaaaaaaaaaaaaaaalllllllllllllllllllllllllllloooooooooooooooooooooooooooooooo";
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
        header('Location: ../Views/create_delete_users.php');
    }
}
?>