<?php
include_once('functions.php');
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si on a reçu les données d'un formulaire et qu'elles ne sont pas vident
if( isset( $_POST[ 'UserName' ] ) && isset( $_POST[ 'Password' ] ) && !empty($_POST[ 'UserName' ] ) && !empty($_POST[ 'Password' ] ))
{
    // On les récupère
    $username = $_POST[ 'UserName' ];
    $password = $_POST[ 'Password' ];

    // On teste si les informations sont valides
    if( verification( $username, $password ) )
    {
        $_SESSION[ 'connected' ] = true;
        $_SESSION[ 'username' ] = $username;
        $time = @date('[d/M/Y:H:i:s]');
        loginManager($username,$time,$_SERVER['REMOTE_HOST']);
        header('Location: ../Views/index.php');
    }
    else
    {
        // Sinon on avertit l'utilisateur
        $_SESSION[ 'connection_info' ] =  "Le Nom d'utilisateur et/ou le mot de passe incorrect. Réessayez.";
        header('Location: ../Views/login.php');
    }
}

function verification( $username, $password )
{
    // On va récupérer l'utilisateur précis
    $reponse = getUser($username);

    // On vérifie si username et mot de passe correspondent
    if (($reponse[0][ "Pass_word" ] == $password) )
    {
        $connected = true;
        // le nom et le prénom servent à assurer à l'utilisateur qu'il est connecté  et connecté avec le bon compte
        $_SESSION['first_name'] = $reponse[0]['FirstName'];
        $_SESSION['last_name'] = $reponse[0]['LastName'];

    } else {
        $connected = false;
    }
    return $connected;
}