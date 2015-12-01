<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/30/2015
 * Time: 11:33 AM
 */

if (isset($_POST['create'])) {

    $i = 0;
    $username = NULL;
    $password = NULL;
    $firstName = NULL;
    $lastName = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
    if (isset($_POST['Username']) && isset($_POST['NewPassword']) && isset($_POST['FirstName']) && isset($_POST['LastName'])) {
        $username = $_POST['Username'];
        $password = $_POST['NewPassword'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
    }

    $bdd = dbConnect();

//Vérification du mot de passe
    if (!empty($password)) {
        $error_passwordconfirm = '- Le mot de passe et sa confirmation sont différents. \n';
        $i++;
    }

// S'il n'y a aucune erreur
    if ($i == 0) {
        createUser($bdd, $username, $password, $firstName, $lastName);

        header('Location: ../Views/index.php');
    } else {
        header('Location: ../Views/create_delete_users.php');
    }
}
else if (isset($_POST['delete'])){

    $i = 0;
    $username = NULL;
    $password = NULL;
    $firstName = NULL;
    $lastName = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
    if (isset($_POST['Username']) && isset($_POST['NewPassword']) && isset($_POST['FirstName']) && isset($_POST['LastName'])) {
        $username = $_POST['Username'];
        $password = $_POST['NewPassword'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
    }

    $bdd = dbConnect();

//Vérification du mot de passe
    if (!empty($password)) {
        $error_passwordconfirm = '- Le mot de passe et sa confirmation sont différents. \n';
        $i++;
    }

// S'il n'y a aucune erreur
    if ($i == 0) {
        deleteUser($bdd, $username, $password, $firstName, $lastName);

        header('Location: ../Views/index.php');
    } else {
        header('Location: ../Views/create_delete_users.php');
    }
}
?>