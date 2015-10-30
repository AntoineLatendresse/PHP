<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-10-30
 * Time: 11:43
 */
include_once("ScriptController.php");
?>

<!DOCTYPE html>
<html>
<title>Page Title</title>
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

</body>
</html>