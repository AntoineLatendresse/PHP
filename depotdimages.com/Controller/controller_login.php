<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:06
 */

	// Initialisation de la session
	session_start();
	include_once('functions.php');


	// Si on a reçu les données d'un formulaire et qu'elles ne sont pas vident
	if( isset( $_POST[ 'UserName' ] ) && isset( $_POST[ 'Password' ] ) && !empty($_POST[ 'UserName' ] ) && !empty($_POST[ 'Password' ] ))
    {
        // On les récupère
        $username = $_POST[ 'UserName' ];
        $password = $_POST[ 'Password' ];

        $_SESSION[ 'username' ] = $username;

        // On teste si les informations sont valides
        if( verification( $username, $password ) )
        {
            unset($_SESSION[ 'username' ]);
            $_SESSION[ 'connected' ] = true;
            header('Location: ../Views/index.php');
        }
        else
        {
            // Sinon on avertit l'utilisateur
            $_SESSION[ 'connection_info' ] =  "Nom d'utilisateur ou mot de passe invalide.";
            header('Location: ../Views/login.php');
        }
    }
    else
    {
        $_SESSION[ 'connection_info' ] =  "Un ou plusieurs champs sont vident.";
        header('Location: ../Views/login.php');
    }

	function verification( $username, $password )
    {

        // On va récupérer l'utilisateur précis
        $reponse = getUser($username);

        // On vérifie si username et mot de passe correspondent
        if (($reponse[0][ "Pass_word" ] == $password) )
        {
            $connected = true;
            // le nom et le prénom servent à assurer à l'utilisateur qu'il est connecté
            // et connecté avec le bon compte
            $_SESSION['first_name'] = $reponse[0]['Prenom'];
            $_SESSION['last_name'] = $reponse[0]['Nom'];

        } else {
            $connected = false;
        }

        return $connected;
    }



	?>