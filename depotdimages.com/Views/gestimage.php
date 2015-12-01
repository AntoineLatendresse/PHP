<?php
include_once("../Controller/functions.php");
showHeader();
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        getGestImages($_POST['imageClick']);
        ?>
    </div>
    </body>
    </html>
<?php
showFooter();
?>