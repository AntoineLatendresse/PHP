<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-10-29
 * Time: 12:15
 */
function saveToFile()
{
    if(isset($_POST['submit'])){
//Create File Name
        $myfile = fopen("test.txt", "w");

//Enter values from website to variables
        $chien = $_POST['Chien'];
        $chat = $_POST['Chat'];
        $oiseau = $_POST['Oiseau'];
        $serpent = $_POST['Serpent'];
        $singe = $_POST['Singe'];

//Write values in file
        fwrite($myfile, $chien . "\n");
        fwrite($myfile, $chat . "\n");
        fwrite($myfile, $oiseau . "\n");
        fwrite($myfile, $serpent . "\n");
        fwrite($myfile, $singe . "\n");
    }
    else{
        echo '<br>Erreur de submit';
    }
}

function afficher_tableau($tab) {
    echo '<h3>Votre animal favoris</h3><br>';

    echo "Les resultats du tableaux sont  :<br>";

    echo '<br>';

    for ($i = 0; $i < sizeof($tab); $i++) {
        echo $tab[$i]."<br>";
    }

    echo '<br>';

    echo '<a href="../Labo1_PHP/ViewFormulaire.html"">Voter</a>';
}

$tableau = array("Animal,Nombre,Pourcentage,Historigramme","Chien,0,0,0", "Chat,0,0,0", "Oiseau,0,0,0","Serpent,0,0,0", "Singe,0,0,0");

afficher_tableau($tableau);
saveToFile();

?>