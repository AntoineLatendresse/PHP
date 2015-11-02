<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-10-30
 * Time: 11:43
 */
include_once("ScriptController.php");
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<div>
    <h3>Votre animal favoris</h3>
    <fieldset>
    <table>
        <tr>
            <td>Chien:</td>
            <td><span>1</span></td>
            <td><span>25%</span></td>
            <td><meter value="0.25"></meter></td>
        </tr>
        <tr>
            <td>Chat:</td>
            <td><span>0</span></td>
            <td><span>0</span></td>
            <td><meter value="0.0"></meter></td>
        </tr>
        <tr>
            <td>Oiseau:</td>
            <td><span>1</span></td>
            <td><span>25%</span></td>
            <td><meter value="0.25"></meter></td>
        </tr>
        <tr>
            <td>Serpent:</td>
            <td><span>2</span></td>
            <td><span>50%</span></td>
            <td><meter value="0.5"></meter></td>
        </tr>
        <tr>
            <td>Singe</td>
            <td><span>0</span></td>
            <td><span>0%</span></td>
            <td><meter value="0.0"></meter></td>
        </tr>
    </table>
    </fieldset>
</div>

<div>
    </br>
    <a href="ScriptFormulaire.php">Voter</a>
</div>

<form action="../Labo1_PHP/ScriptController.php" method="post" id="Couleurs">
    </br>
    <input id="Vert" type="radio" name="Couleurs" value="Vert">Teintes de vert<br>
    <input id="Rouge" type="radio" name="Couleurs" value="Rouge">Teintes de rouge<br>
    <input id="Bleu" type="radio" name="Couleurs" value="Bleu">Teintes de bleu<br>
</form>

</body>
</html>