<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
session_start();
showHeaderLogin();
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>All your photos organized and easy to find</title>
        <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
    </head>
    <body>
    <div class="wrap">
        <br>
        <form action="../Controller/controller_login.php" method="post">
            <label class="control-label col-md-2">Nom d'usager :</label>
            <div class="col-md-10">
                <input class="text-box single-line" id="UserName" name="UserName" type="text" value="<?php if (isset($_SESSION[ 'username' ])) echo htmlentities(trim($_SESSION[ 'username' ])); ?>" title=""/>
            </div>
            <br>
            <label class="control-label col-md-2">Mot de passe :</label>
            <div class="col-md-2">
                <input class="text-box single-line password" id="Password" name="Password" type="password" value="" title=""/>
            </div>
            <br>
            <div class="col-md-offset-2 col-md-2"><input type="submit" value="Soumettre..." class="button" /> <br /><br /></div>

        </form>
    </div>
    </body>
    </html>
<?php
showFooter();
?>