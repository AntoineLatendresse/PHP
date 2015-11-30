<?php
include_once("../Controller/functions.php");
showHeader();
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */

upload_Image();
delete_Image();
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>All your photos organized and easy to find</title>
        <meta charset="utf-8"  content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../css/main.css" />
        <noscript><link rel="stylesheet" href="../css/noscript.css" /></noscript>
    </head>

    <body>
    <div class="wrap">
        <h1>Your photos: </h1>
        <?php
        $file_names = show_Images();
        echo '<br>'.'<br>'.$file_names;
        ?>
    </div>
    <div class="wrap">
        <h1>Upload your photos: </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image"/>
            <input class="button" type="submit" value="Upload Image" name="upload_img" />
        </form>
    </div>
    <div class="wrap">
        <form action="" method="post">

            <h1>Delete your photos: </h1>
            <input type="text" name="filename" title=""/>
            <input type="submit" value="Delete Image" name="delete_img"/>
        </form>
    </div>
    </body>
    </html>
<?php
showFooter();
?>