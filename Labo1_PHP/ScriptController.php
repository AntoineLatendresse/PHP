<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-10-30
 * Time: 11:45
 */

if(isset($_POST["Animaux"]))
{
    Vote($_POST["Animaux"]);
}

function Vote($Vote)
{
    $chien = 0;
    $chat = 0;
    $oiseau = 0;
    $serpent = 0;
    $singe = 0;

    //premiere approche

    /*//Create File Name
    $myfile = fopen("FichierText.txt", "w");

    //Enter values from website to variables
    $radioButtonSelected = $_POST['Animaux'];

    //Write values in file
    fwrite($myfile, $radioButtonSelected . "\n");*/


    //Deuxieme approche
    switch($_POST['Animaux']) {
        case "Chien":
            $chien++;
            echo $chien;
            break;
        case "Chat":
            $chat++;
            echo $chat;
            break;
        case "Oiseau":
            $oiseau++;
            echo $oiseau;
            break;
        case "Serpent":
            $serpent++;
            echo $serpent;
            break;
        case "Singe":
            $singe++;
            echo $singe;
            break;
    }
}

?>