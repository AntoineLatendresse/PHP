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
        <link href='https://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
        <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
        <link rel="apple-touch-icon" sizes="57x57" href="ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
        <link rel="manifest" href="ico/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
    <div class="wrap">
        <h1>_Your's photo, but BIGGER_</h1>
        <hr><br/>
        <?php echo "<a><img style='max-height:600px; max-width: 800px;' src=". $_SESSION['imageSelect'] . "/></a>"; ?>
        <br/><br/><hr><br/>
    </div>
    <div class="wrap" align="center">
        <form action="../Controller/functions.php" method="post">
            <table>
                <tr><td><textarea class="inputText" placeholder="Comment" id="Password" style=" resize: none;" name="comment" rows="10" cols="50" maxlength="150" title=""></textarea></td></tr>
                <tr><td><input class="button" type="submit" name="CommentaireEnvoyer" value="Comment"></td></tr>
            </table>
            <br/><hr/><br/><br/>
            <?php
            CommentManager();
            ?>
            <br/><hr/><br/>
        </form>
    </div>
    <?php if($_SESSION['username'] == PhotoManager() || $_SESSION['username'] == 'Admin')
    {
        ?>
        <div class="wrap">
            <form action="../Controller/functions.php" method="post" enctype="multipart/form-data">
                <h1>Delete your's photos: </h1>
                <input class="button" type="submit" value="Delete Image" name="SupprimerImage"/>
            </form>
        </div>
        <?php
    }
    ?>
    </body>
    </html>
<?php
showFooter();
?>