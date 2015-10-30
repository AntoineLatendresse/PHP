<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-10-30
 * Time: 11:43
 */
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <h3>Quel est votre animal favoris?</h3>
    <fieldset>
        <form action="../Labo1_PHP/ScriptFormulaire.php" method="post" id="Animaux">
            <input id="Chien" type="radio" name="Animaux" value="Chien">Chien<br>
            <input id="Chat" type="radio" name="Animaux" value="Chat">Chat<br>
            <input id="Oiseau" type="radio" name="Animaux" value="Oiseau">Oiseau<br>
            <input id="Serpent" type="radio" name="Animaux" value="">Serpent<br>
            <input id="Singe" type="radio" name="Animaux" value="Singe">Singe<br>
        </form>
    </fieldset>
    <br>
    <button type="submit" form="Animaux" value="Submit">Submit</button>
</head>
<body>

</body>
</html>