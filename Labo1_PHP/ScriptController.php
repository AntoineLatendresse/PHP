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
    //Create File Name
    $myfile = fopen("FichierText.txt", "w");

    //Enter values from website to variables
    $radioButtonSelected = $_POST['Animaux'];

    //Write values in file
    fwrite($myfile, $radioButtonSelected . "\n");
}

?>