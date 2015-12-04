<?php
include_once("../Controller/functions.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
getSessionVar();
showHeader("Gestionnaire d'images");
verifyConnected();
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
        <h1>Your photos: </h1>
        <?php
        echo "<img style='max-height:600px; max-width: 800px; height:auto; width:auto; display:block;' src=" . $_SESSION['imageSelect'] . " >";
        ?>
    </div>
    <form action="gestimage.php" method="POST">
        <table>
            <tr><td>Name: <br><input type="text" name="name" title=""/></td></tr>
            <tr><td colspan="2">Comment: </td></tr>
            <tr><td colspan="5"><textarea name="comment" rows="10" cols="50" title=""></textarea></td></tr>
            <tr><td colspan="2"><input type="submit" name="submit" value="Comment"></td></tr>
        </table>
    </form>
    </body>
    </html>
<?php
showFooter();
?>