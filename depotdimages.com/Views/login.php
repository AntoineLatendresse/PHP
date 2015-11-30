<?php

/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 14:59
 */
session_start();

include_once("../Controller/functions.php");
showHeader();
verifyConnected();

?>

    <!DOCTYPE html>
    <html>


    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
    </head>
    <body>
    <div class="wrap">

        <br>

        <form action="../Controller/controller_login.php" method="post">

            <label class="control-label col-md-2">Nom d'usager :</label>
            <div class="col-md-10">
                <input class="text-box single-line" data-val="true" id="UserName" name="UserName" type="text" value="<?php if (isset($_SESSION[ 'username' ])) echo htmlentities(trim($_SESSION[ 'username' ])); ?>" title=""/>
            </div>
            <br>

            <label class="control-label col-md-2">Mot de passe :</label>
            <div class="col-md-2">
                <input class="text-box single-line password" data-val="true" id="Password" name="Password" type="password" value="" title=""/>
            </div>
            <br>

            <div class="col-md-offset-2 col-md-2">
                <input type="submit" value="Soumettre..." class="button" /> <br /><br />
            </div>

        </form>
    </div>
    </body>
    </html>
<?php
showFooter();
?>